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
use \App\Http\Controllers\Admin\ChartController;

use \App\Http\Controllers\Customer\CustomerController;
use \App\Http\Controllers\Customer\UserControllerFE;
use \App\Http\Controllers\Customer\CartController;
use \App\Http\Controllers\Customer\CheckoutController;
use App\Models\Order;

Route::prefix('/')->group(function (){
    Route::get('',[CustomerController::class,'index'])->name('index');

    Route::get('showlogin',[UserControllerFE::class,'showLogin'])->name(("showlogin"));
    Route::post('login',[UserControllerFE::class,'Login'])->name(('loginUser'));
    Route::get('login',[UserControllerFE::class,'Login']);
    Route::get('showregister',[UserControllerFE::class,'showRegister'])->name(("ShowRegister"));
    Route::post('register',[UserControllerFE::class,'register'])->name(('register'));
    Route::get('vertified/{user}/{token}',[UserControllerFE::class,'vertified'])->name(("vertified"));   
    Route::get('forgot-password',[UserControllerFE::class,'show_forgot_password'])->name(("forgot-password"));
    Route::post('forgot-password',[UserControllerFE::class,'forgot_password'])->name(("forgotPass"));  
    Route::get('get-password/{user}/{token}',[UserControllerFE::class,'get_password'])->name(("getpassword"));
    Route::post('get-password/{user}/{token}',[UserControllerFE::class,'post_password'])->name(("postpassword"));   
    Route::get('logout',[UserControllerFE::class,'logout'])->name(("logout"));
    Route::get('send_mail',[UserControllerFE::class,'send_mail']);

    Route::get('profile',[UserControllerFE::class,'profile'])->name(("profile"));

    Route::get('home',[UserControllerFE::class,'Dashboard']);//->middleware('isLoggedIn');


    
    Route::get('product/{cateID?}/{keyword?}',[CustomerController::class,'product'])->name('product');
    Route::prefix('product-detail')->group(function (){
        Route::get('{product}',[CustomerController::class,'product_detail']);
       // Route::get('',[FrontEndController::class,'product_detail']);
    });
    Route::get('contact',[CustomerController::class,'contact'])->name('contact');

    // Cart
    Route::get('cart',[CartController::class,'cart'])->name('cart');
    Route::post('addtocart',[CartController::class,'addToCart'])->name('addtocart');
    Route::post('saveCart',[CartController::class,'save_cart']);
    Route::get('showcart',[CartController::class,'show_cart']);
    Route::get('delete-to-cart',[CartController::class,'delete_to_cart']);
    Route::DELETE('delete-to-cart',[CartController::class,'delete_to_cart']);
    Route::post('updateQty',[CartController::class,'update_cart_qty']);
    //checkout
    Route::get('check-login-checkout',[CheckoutController::class,'check_login_checkout']);
    Route::post('save-checkout-cus',[CheckoutController::class,'save_checkout_cus']);
    Route::get('checkout',[CheckoutController::class,'show_checkout']);

});


//
//#SEND MAIL 

//
//
  ##Admin
    Route::get('/admin/login',[LoginController::class,'index'])->name('login');
    Route::post('/admin/admin_login',[LoginController::class, 'store']);

    Route::middleware('auth')->group(function (){
        Route::prefix('admin')->group(function (){
            Route::get('main', [MainController::class, 'index'])->name('admin');
            Route::get('home',[AdminController::class, 'index']);
            Route::get('dashboard',[AdminController::class, 'index']);
            Route::get('logout',[LoginController::class, 'logout']);
            Route::get('profile',[LoginController::class, 'profile']);
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
            Route::get('admin_add',[UserController::class, 'create']);
            Route::get('admin_list',[UserController::class, 'getAdmins']);
            Route::get('customer_list',[UserController::class, 'getCustomers']);
            Route::post('save_user',[UserController::class, 'store']);
            Route::get('admin_edit/{user}',[UserController::class, 'show']);
            Route::post('admin_edit/{user}',[UserController::class, 'update']);
            Route::post('admin_save',[UserController::class, 'store']);
            Route::DELETE('admin_destroy',[UserController::class, 'destroy']);

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


// DataAnalytics

    Route::get('/chart', [ChartController::class, 'index']);
    Route::get('fetch_data', [ChartController::class, 'fetch_data']);


