<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer(['header', 'loaisp'], function ($view) {
        //     $producttypes = ProductType::all();
        //     //truyền biến $producttypes cho view header thông qua biến $view
        //     $view->with('producttypes', $producttypes);
        // });

        //chia sẻ biến Session('cart') cho các view header.blade.php và checkout.php
        View::composer(['master', 'checkout', 'vnpay-index'], function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'), 'productCarts' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });
    }
}
