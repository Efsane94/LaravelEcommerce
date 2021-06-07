<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\CategoryManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Middleware\AdminMV;
use App\Models\User;
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
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function() {
    Route::redirect('/','/admin/login');

    Route::match(['get','post'],'/login', [AdminController::class, 'login'])->name("admin.login");
    Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware([AdminMV::class])->group( function() {
        Route::get('/homepage', [HomePageController::class, 'index'])->name('admin.homepage');
        });

    Route::group(['prefix'=>'usermanagement'],function(){
            Route::match(['get','post'],'/', [UserManagementController::class, 'index'])->name("admin.usermanagement");
            Route::get('/create', [UserManagementController::class, 'form'])->name("admin.usermanagement.create");
            Route::get('/update/{id}', [UserManagementController::class, 'form'])->name("admin.usermanagement.update");
            Route::post('/save/{id?}', [UserManagementController::class, 'save'])->name("admin.usermanagement.save");
            Route::get('/delete/{id}', [UserManagementController::class, 'delete'])->name("admin.usermanagement.delete");
        });
    Route::group(['prefix'=>'category'],function(){
            Route::match(['get','post'],'/', [CategoryManagementController::class, 'index'])->name("admin.category");
            Route::get('/create', [CategoryManagementController::class, 'form'])->name("admin.category.create");
            Route::get('/update/{id}', [CategoryManagementController::class, 'form'])->name("admin.category.update");
            Route::post('/save/{id?}', [CategoryManagementController::class, 'save'])->name("admin.category.save");
            Route::get('/delete/{id}', [CategoryManagementController::class, 'delete'])->name("admin.category.delete");
        });

    Route::group(['prefix'=>'product'],function(){
        Route::match(['get','post'],'/', [ProductManagementController::class, 'index'])->name("admin.product");
        Route::get('/create', [ProductManagementController::class, 'form'])->name("admin.product.create");
        Route::get('/update/{id}', [ProductManagementController::class, 'form'])->name("admin.product.update");
        Route::post('/save/{id?}', [ProductManagementController::class, 'save'])->name("admin.product.save");
        Route::get('/delete/{id}', [ProductManagementController::class, 'delete'])->name("admin.product.delete");
    });

    Route::group(['prefix'=>'order'],function(){
        Route::match(['get','post'],'/', [OrderManagementController::class, 'index'])->name("admin.order");
        Route::get('/create', [OrderManagementController::class, 'form'])->name("admin.order.create");
        Route::get('/update/{id}', [OrderManagementController::class, 'form'])->name("admin.order.update");
        Route::post('/save/{id?}', [OrderManagementController::class, 'save'])->name("admin.order.save");
        Route::get('/delete/{id}', [OrderManagementController::class, 'delete'])->name("admin.order.delete");
    });
});
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{slug}', [CategoryController::class, 'index'])->name("category");

Route::get('/product/{slug}', [ProductController::class, 'index'])->name("product");

Route::get('/search',[ProductController::class, 'search'] )->name("search");
//Route::post('/search',[ProductController::class, 'search'] )->name("search");


Route::group(['prefix'=>'cart'], function(){
    Route::get('/', [CartController::class, 'index'])->name("cart");
    Route::post('/add', [CartController::class, 'add'])->name("cart.add");
    Route::delete('/delete/{rowId}', [CartController::class, 'delete'])->name("cart.delete");
    Route::delete('/empty', [CartController::class, 'empty'])->name("cart.empty");
    Route::patch('/update/{rowId}', [CartController::class, 'update'])->name("cart.update");
});

Route::get('/payment', [PaymentController::class, 'index'])->name("payment");
Route::post('/payment', [PaymentController::class, 'repayment'])->name("repayment");

Route::group(['middleware'=>'auth'], function(){
    Route::get('/order', [OrderController::class, 'index'])->name("orders");
    Route::get('/orderdetails/{id}', [OrderController::class, 'details'])->name("order");
});

Route::group(['prefix'=>'user'],function(){
    Route::get('/register', [UserController::class, 'register'])->name("user.register");
    Route::post('/register', [UserController::class, 'store']);
    Route::get('/login', [UserController::class, 'login_form'])->name("user.login");
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/confirm/{key}',[UserController::class,'confirm'])->name('confirm');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

