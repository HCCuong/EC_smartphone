<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\Admin\CategoryProduct;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\OrderController;
use \App\Http\Controllers\Admin\UserController;
use App\Models\Order;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/cart', function () {
    return view('cart');
});

    ##Admin
    Route::get('/admin/login',[LoginController::class,'index'])->name('login');
    Route::post('/admin/admin_login',[LoginController::class, 'store']);

    Route::middleware('auth')->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('main', [MainController::class, 'index'])->name('admin');
            Route::get('home',[AdminController::class, 'index']);
            Route::get('dashboard',[AdminController::class, 'index']);
            Route::get('logout',[LoginController::class, 'logout']);
            Route::get('logout',[LoginController::class, 'profile']);
            Route::get('user_detail/{userid}',[UserController::class, 'getUserDetails']);

            #Category
            Route::get('cate_add',[CategoryProduct::class, 'create']);
            Route::get('cate_list',[CategoryProduct::class, 'index']);
            Route::post('save_category',[CategoryProduct::class, 'store']);
            //Route::DELETE('cate_destroy',[CategoryProduct::class, 'destroy']);
            Route::get('cate_edit/{category}',[CategoryProduct::class, 'show']);
            Route::post('cate_edit/{category}',[CategoryProduct::class, 'update']);


            #Product
            Route::get('product_add',[ProductController::class, 'create']);
            Route::get('product_list',[ProductController::class, 'index']);
            /*Route::post('/admin/save_product',[ProductController::class, 'save_category']);*/
            Route::post('save_product',[ProductController::class, 'store']);
            Route::get('product_edit/{product}',[ProductController::class, 'show']);
            Route::post('product_edit/{product}',[ProductController::class, 'update']);
            Route::DELETE('product_destroy',[ProductController::class, 'destroy']);
            Route::get('product_detail/{productid}',[ProductController::class, 'getProductDetails']);


            #Upload
            Route::post('upload', [UploadController::class, 'store']);

            #Order
            Route::get('order_list_done',[OrderController::class, 'index']);
            /*Route::post('/admin/save_product',[ProductController::class, 'save_category']);*/
            Route::get('order_list_cancel',[OrderController::class, 'get_list_cancel']);
            Route::get('order_list_new',[OrderController::class, 'get_list_new']);
            //Route::get('order_detail/{order}',[OrderController::class, 'show']);
            Route::get('order_detail/{orderid}',[OrderController::class, 'getOrderDetails']);


            #User
            Route::get('user_add',[UserController::class, 'create']);
            Route::get('user_list',[UserController::class, 'index']);
            Route::post('save_user',[UserController::class, 'store']);
            Route::get('user_edit/{user}',[UserController::class, 'show']);
            Route::post('user_edit/{user}',[UserController::class, 'update']);
            Route::DELETE('user_destroy',[UserController::class, 'destroy']);

            #Slider
            Route::get('slider_add',[UserController::class, 'create']);
            Route::get('slider_list',[UserController::class, 'index']);
            Route::post('save_slider',[UserController::class, 'store']);
            Route::get('slider_edit/{slider}',[UserController::class, 'show']);
            Route::post('slider_edit/{slider}',[UserController::class, 'update']);
            Route::DELETE('slider_destroy',[UserController::class, 'destroy']);
        });
    });


    //Route::get('/admin/home',[AdminController::class, 'adminlayout']);

    //Route::get('/admin/dashboard',[AdminController::class,'showdashboard']);
    //Route::post('/admin/adminlayout',[AdminController::class, 'log_in']);

    //Route::get('/admin/adminlayout',[AdminController::class, 'adminlayout']);
    //Route::get('/admin/log_out',[AdminController::class, 'log_out']);

    /*Category Product*/





