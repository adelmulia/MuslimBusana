<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('dw-carts'), true);
        $carts = $carts != '' ? $carts : [];
        return $carts;
    }
    public function addToCart(Request $request)
    {
        //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'product_id' => 'required|exists:products,id', //PASTIKAN PRODUCT_IDNYA ADA DI DB
            'qty' => 'required|integer' //PASTIKAN QTY YANG DIKIRIM INTEGER
        ]);

        //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
        $carts = $this->getCarts();

        //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
        if ($carts && array_key_exists($request->product_id, $carts)) {
            //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            //SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
            $product = Product::find($request->product_id);
            //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image
            ];
        }

        //BUAT COOKIE-NYA DENGAN NAME HS-CARTS
        //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
        $cookie = cookie('hs-carts', json_encode($carts), 2880);
        //STORE KE BROWSER UNTUK DISIMPAN
        return redirect()->back()->cookie($cookie);
    }
    public function listCart()
    {
        //MENGAMBIL DATA DARI COOKIE
        $carts = json_decode(request()->cookie('hs-carts'), true);
        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['product_price']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });
        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        return view('pages.cart', compact('carts', 'subtotal'));
    }

    public function checkout()
    {

        $carts = $this->getCarts(); //MENGAMBIL DATA CART
        //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['product_price'];
        });
        //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
        return view('pages.checkout', compact('carts', 'subtotal'));
    }

    public function processCheckout(Request $request)
    {
        //VALIDASI DATANYA

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
        ]);

        //INISIASI DATABASE TRANSACTION
        //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
        DB::beginTransaction();
        try {
            //CHECK DATA CUSTOMER BERDASARKAN EMAIL
            $customer = Customer::where('email', $request->email)->first();
            //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
            // if (!auth()users->check() && $customer) {
            //     //MAKA REDIRECT DAN TAMPILKAN INSTRUKSI UNTUK LOGIN 
            //     return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
            // }

            //AMBIL DATA KERANJANG
            $carts = $this->getCarts();
            //HITUNG SUBTOTAL BELANJAAN
            $subtotal = collect($carts)->sum(function ($q) {
                return $q['qty'] * $q['product_price'];
            });

            //SIMPAN DATA CUSTOMER BARU
            $customer = Customer::create([
                'name' => $request->customer_name,
                'email' => $request->email,
                'phone_number' => $request->customer_phone,
                'address' => $request->customer_address,
                'status' => false
            ]);

            //SIMPAN DATA ORDER
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'subtotal' => $subtotal
            ]);

            //LOOPING DATA DI CARTS
            foreach ($carts as $row) {
                //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
                $product = Product::find($row['product_id']);
                //SIMPAN DETAIL ORDER
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $row['product_id'],
                    'price' => $row['product_price'],
                    'qty' => $row['qty'],
                    'weight' => $product->weight
                ]);
            }

            //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
            DB::commit();

            $carts = [];
            //KOSONGKAN DATA KERANJANG DI COOKIE
            $cookie = cookie('hs-carts', json_encode($carts), 2880);
            //REDIRECT KE HALAMAN FINISH TRANSAKSI
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
            DB::rollback();
            //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        //AMBIL DATA PESANAN BERDASARKAN INVOICE
        $order = Order::where('invoice', $invoice)->first();
        //LOAD VIEW checkout_finish.blade.php DAN PASSING DATA ORDER
        return view('pages.checkout_finish', compact('order'));
    }
}