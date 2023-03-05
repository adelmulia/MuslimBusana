<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\LoginCustomerController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-produk/{id}', [DetailProductController::class, 'index'])->name('detail-produk');
Route::post('cart', [CartController::class, 'addToCart'])->name('front.cart');
Route::get('/cart', [CartController::class, 'listCart'])->name('front.list_cart');

Route::post('/cart/update', [CartController::class, 'updateCart'])->name('front.update_cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('front.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('front.finish_checkout');


Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function () {
    Route::get('login', [LoginCustomerController::class, 'loginform'])->name('customer.login'); //TAMBAHKAN ROUTE INI
    Route::get('verify/{token}', [HomeController::class, 'verifyCustomerRegistration'])->name('customer.verify');
    Route::post('login', [LoginCustomerController::class, 'login'])->name('customer.post_login');
});

Route::group(['middleware' => 'customer'], function () {
    Route::get('dashboard', [LoginCustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('logout', [LoginCustomerController::class, 'logout'])->name('customer.logout'); //TAMBAHKAN BARIS INI

});

// admin
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/category', '\App\Http\Controllers\Admin\CategoryController');
        Route::resource('/product', '\App\Http\Controllers\Admin\ProductController');
        Route::resource('/order', '\App\Http\Controllers\Admin\OrderController');
        Route::get('/{invoice}', [OrderController::class], 'view')->name('order.view');
    });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');