<?php

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
    return view('welcome');
});
// Route::resource('product', ProductController::class);
Route::get('product/create',[ProductController::class, 'create'])->name('create');

Route::get('product/page/{page}',[ProductController::class, 'getlist'])->name('getlist');
Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('edit');
Route::delete('product/destroy/{id}',[ProductController::class, 'destroy'])->name('destroy');
Route::post('product/store/',[ProductController::class, 'store'])->name('store');
Route::post('product/update/{id}',[ProductController::class, 'update'])->name('update');
