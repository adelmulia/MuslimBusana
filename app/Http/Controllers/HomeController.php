<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data =  Product::all();
        return view('pages.index', compact('data'));
    }

    public function verifyCustomerRegistration($token)
    {
        //JADI KITA BUAT QUERY UNTUK MENGMABIL DATA USER BERDASARKAN TOKEN YANG DITERIMA
        $customer = Customer::where('activate_token', $token)->first();
        if ($customer) {
            //JIKA ADA MAKA DATANYA DIUPDATE DENGNA MENGOSONGKAN TOKENNYA DAN STATUSNYA JADI AKTIF
            $customer->update([
                'activate_token' => null,
                'status' => 1
            ]);
            //REDIRECT KE HALAMAN LOGIN DENGAN MENGIRIMKAN FLASH SESSION SUCCESS
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
        //JIKA TIDAK ADA, MAKA REDIRECT KE HALAMAN LOGIN
        //DENGAN MENGIRIMKAN FLASH SESSION ERROR
        return redirect(route('customer.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }
}
