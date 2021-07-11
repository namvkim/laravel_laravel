<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/', indexController::class);

Route::get('/product_type', function () {
    return view('product_type');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [indexController::class, 'postLogin']);

Route::get('/signup', function () {
    return view('signup');
});
Route::post('/signup', [indexController::class, 'postSignup']);

Route::get('/email', function () {
    return view('email.inputEmail');
});
Route::post('/sendEmail', [emailController::class, 'sendEmail'])->name('sendEmail');

Route::get('/add-to-cart/{id}', [PageController::class, 'addToCart'])->name('banhang.addtocart');
Route::get('/add-many-to-cart/{id}', [PageController::class, 'addManyToCart'])->name('banhang.addmanytocart');

Route::get('/dathang', [PageController::class, 'getCheckout'])->name('banhang.getdathang');
Route::post('/dathang', [PageController::class, 'postCheckout'])->name('banhang.postdathang');
Route::get('/del-cart/{id}', [PageController::class, 'delCartItem'])->name('banhang.xoagiohang');

Route::get('/vnpay-index', function () {
    return view('admin.vnpay-index');
});
Route::post('/vnpay/create_payment', [PageController::class, 'createPayment'])->name('postCreatePayment');
Route::get('/vnpay_return', [PageController::class, 'vnpayReturn'])->name('vnpayReturn');

// admin
Route::get('/admin/dangnhap', [adminController::class, 'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap', [adminController::class, 'postLogin'])->name('admin.postLogin');
// Route::get('/admin/dangxuat',[UserController::class,'getLogout']);

Route::group(['middleware' => 'checkAdmin'], function () {
    Route::get('/admin/confirm', [adminController::class, 'getConfirm']);
    Route::get('/admin/delivery', [adminController::class, 'getDelivery']);
    Route::get('/admin/complete', [adminController::class, 'getComplete']);
    Route::get('/admin/payments', [adminController::class, 'getPayments']);
    Route::get('/admin/delete', [adminController::class, 'getDelete']);
    Route::get('/admin/postConfirm', [adminController::class, 'postConfirm']);
    Route::get('/admin/postDelivery', [adminController::class, 'postDelivery']);
    Route::get('/admin/postDelete', [adminController::class, 'postDelete']);
});
