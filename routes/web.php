<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

Route::get('/category/{categoryname}', [CategoryController::class, 'index'])->name("category");

Route::get('/product/{productname}', [ProductController::class, 'index'])->name("product");

Route::get('/cart', [CartController::class, 'index'])->name("cart");

Route::get('/payment', [PaymentController::class, 'index'])->name("payment");

Route::get('/order', [OrderController::class, 'index'])->name("orders");

Route::get('/orderdetails/{id}', [OrderController::class, 'details'])->name("order");

Route::group(['prefix'=>'user'],function(){
    Route::get('/register', [UserController::class, 'register'])->name("user.register");
    Route::get('/login', [UserController::class, 'login'])->name("user.login");
});
