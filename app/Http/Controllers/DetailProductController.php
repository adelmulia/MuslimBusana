<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    public function index($id)
    {
        $data = Product::find($id);
        return view('pages.detail-produk', compact('data'));
    }
}
