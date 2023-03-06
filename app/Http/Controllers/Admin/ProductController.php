<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with(['category'])->paginate(5);

        return view('pages.admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:55',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename);

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->weight,
                'category_id' => $request->category_id,
                'image' => $filename,
                'slug' => Str::slug($request->name),

            ]);
            return redirect(route('product.index'))->with(['success' => 'Produk Baru Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::with(['category'])->find($id);
        $category = Category::all();
        return view('pages.admin.product.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:55',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'weight' => 'required',
            // 'image' => 'nullabel|image|mimes:png,jpeg,jpg'
        ]);

        $product = Product::find($id);
        $filename = $product->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/', $filename);
            Storage::delete(storage_path('app/public/uploads/' . $product->image));
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'category_id' => $request->category_id,
            'image' => $filename,
        ]);
        return redirect(route('product.index'))->with(['success' => 'Data Produk Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::withCount(['orderDetail'])->find($id);


        if ($product->order_detail_count == null) {
            if ($product->image) {
                Storage::delete(storage_path('app/public/uploads/' . $product->image));
            }
            $product->delete();
            return redirect(route('product.index'))->with(['success' => 'Produk Dihapus!']);
        }
        return redirect(route('product.index'))->with(['info' => 'Produk berelasi tidak dapat dihapus!']);
    }
}
