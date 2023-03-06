<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'order' => Order::count(),
            'customer' => Customer::count(),
            'category' => Category::count(),
            'product' => Product::count(),


        ]);
    }
}
