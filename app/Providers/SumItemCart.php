<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SumItemCart extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $carts = json_decode(request()->cookie('hs-carts'), true);
        $total = collect($carts)->sum(function ($q) {
            return $q['qty']++; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });
        View::share($total);
    }
}