<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponControlle;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('admin.layout.main');
});
// Route::resource('product', ProductController::class);
Route::get('product/create',[ProductController::class, 'create'])->name('product_create');
Route::get('product/page/{page}',[ProductController::class, 'getlist'])->name('product_getlist');
Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product_edit');
Route::delete('product/destroy/{id}',[ProductController::class, 'destroy'])->name('product_destroy');
Route::post('product/store/',[ProductController::class, 'store'])->name('product_store');
Route::post('product/update/{id}',[ProductController::class, 'update'])->name('product_update');

Route::get('order/create',[OrderController::class, 'create'])->name('order_create');
Route::get('order/page/{page}',[OrderController::class, 'getlist'])->name('order_getlist');
Route::get('order/edit/{id}',[OrderController::class, 'edit'])->name('order_edit');
Route::delete('order/destroy/{id}',[OrderController::class, 'destroy'])->name('order_destroy');
Route::post('order/store/',[OrderController::class, 'store'])->name('order_store');
Route::post('order/update/{id}',[OrderController::class, 'update'])->name('order_update');

Route::post('coupon/create/{id}',[CouponControlle::class, 'createCoupon'])->name('coupon_create');
Route::get('coupon/create/{id}',[CouponControlle::class, 'sendCoupon'])->name('coupon_send');

//Campaign
Route::get('/contact',[ContactController::class, 'index'])->name('contact_index');
Route::post('/send',[ContactController::class, 'send'])->name('send.email');

