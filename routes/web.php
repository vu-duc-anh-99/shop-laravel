<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    //Homepage route
    Route::get('/', 'HomeController@index');
    Route::get('/page/{current_page}', 'HomeController@page');

    Route::get('/trang-chu', 'HomeController@index');

    Route::get('/danh-muc/{category_id}', 'CategoryProduct@show_category_home');
    Route::get('/thuong-hieu/{brand_id}', 'BrandProduct@show_brand_home');

    Route::get('/chi-tiet-san-pham/{product_id}/{product_name}', 'ProductController@product_detail');
    Route::post('/tim-kiem', 'HomeController@search_product');
    //End homepage route

    //Cart
    Route::post('/add-cart', 'CartController@add_cart');
    Route::post('/update-cart', 'CartController@update_cart');
    Route::post('/update-cart-ajax', 'CartController@update_cart_ajax');
    Route::get('/show-cart', 'CartController@show_cart');
    Route::get('/gio-hang', 'CartController@show_cart_ajax');
    Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
    Route::get('/delete-cart-ajax/{sessionId}', 'CartController@delete_cart_ajax');
    Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
    //End cart route    


    //Coupon
    Route::post('/check-coupon', 'CouponController@check_coupon');
    Route::get('/add-coupon', 'CouponController@add_coupon');
    Route::post('/save-coupon', 'CouponController@save_coupon');
    Route::get('/manage-coupon', 'CouponController@list_coupon');
    Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');
    Route::get('/find-coupon/{couponId}', 'CouponController@find_coupon');
    Route::post('/edit-coupon/{couponId}', 'CouponController@edit_coupon');

    //End coupon route


    //Admin
    Route::get('/admin', 'AdminController@index');
    Route::get('/logout', 'AdminController@logout');
    Route::post('/admin-dashboard', 'AdminController@dashboard');
    Route::get('/register', 'AdminController@register_view');
    Route::post('/admin-register', 'AdminController@register');
    Route::group(['middleware' => 'role'], function () {
        // Route::get('/admin', 'AdminController@index')->middleware('roles');
        Route::get('/dashboard', 'AdminController@show_dashboard');


        Route::get('edit-admin/{admin_id}', 'AdminController@edit_form');
        Route::post('/update-admin/{admin_id}', 'AdminController@update_user');
        Route::get('delete-admin/{admin_id}', 'AdminController@delete_user');


        //Slider
        Route::get('/manage-slider', 'SliderController@list_banner');
        Route::get('/manage-slider/page/{current_page}', 'SliderController@page');
        Route::get('/add-slider', 'SliderController@add_slider');
        Route::get('/edit-slider/{slider_id}', 'SliderController@edit_banner');
        Route::post('/update-banner/{slider_id}', 'SliderController@update_banner');
        Route::post('/save-banner', 'SliderController@save_banner');
        Route::get('/active-slider/{slider_id}', 'SliderController@active_banner');
        Route::get('/inactive-slider/{slider_id}', 'SliderController@inactive_banner');
        Route::get('/search-slider/{slider_id}', 'SliderController@search_slider');
        //End slider route


        //Category Product
        Route::get('/add-category-product', 'CategoryProduct@add_category_product');
        Route::get('/list-category-product', 'CategoryProduct@list_category_product');
        Route::get('/list-category-product/page/{current_page}', 'CategoryProduct@page');
        Route::post('/save-category-product', 'CategoryProduct@save_category_product');

        Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
        Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

        Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');

        Route::get('/actived-category-product/{category_product_id}', 'CategoryProduct@actived_category_product');
        Route::get('/not-actived-category-product/{category_product_id}', 'CategoryProduct@not_actived_category_product');

        //Brand Product
        Route::get('/add-brand-product', 'BrandProduct@add_brand_product');
        Route::get('/list-brand-product', 'BrandProduct@list_brand_product');
        Route::get('/list-brand-product/page/{current_page}', 'BrandProduct@page');
        Route::post('/save-brand-product', 'BrandProduct@save_brand_product');


        Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
        Route::post('/update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');

        Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');

        Route::get('/actived-brand-product/{brand_product_id}', 'BrandProduct@actived_brand_product');
        Route::get('/not-actived-brand-product/{brand_product_id}', 'BrandProduct@not_actived_brand_product');

        //Product
        Route::get('/add-product', 'ProductController@add_product');

        Route::get('/list-product/{current_page}', 'ProductController@list_product');
        Route::post('/save-product', 'ProductController@save_product');

        Route::get('/edit-product/{product_product_id}', 'ProductController@edit_product');
        Route::post('/update-product/{product_product_id}', 'ProductController@update_product');

        Route::get('/delete-product/{product_product_id}', 'ProductController@delete_product');

        Route::get('/actived-product/{product_id}', 'ProductController@actived_product');
        Route::get('/not-actived-product/{product_id}', 'ProductController@not_actived_product');

        //Order
        Route::get('/manage-order', 'CheckOutController@manage_order');
        Route::get('/manage-order/page/{current_page}', 'CheckOutController@page');
        Route::get('/edit-order/{order_id}', 'CheckOutController@view_order_detail');
        Route::get('/delete-order/{order_id}', 'CheckOutController@delete_order');
        //ajax
        Route::post('/update-order-qty', 'OrderController@update_order_qty');
    });



    //End admin route

    //Checkout
    Route::get('/login-checkout', "CheckoutController@login_checkout");
    //End checkout

    //Customer route
    Route::post('/customer-register', 'CustomerController@register');
    Route::get('/checkout', 'CustomerController@checkout');
    Route::post('/login', 'CustomerController@login');
    Route::post('/save-checkout-customer', 'CustomerController@save_checkout_customer');
    // Route::get('/payment', 'CustomerController@payment');
    Route::post('/payment-option', 'CheckOutController@payment_option');
    Route::get('/logout-home', 'CustomerController@logout');
    Route::get('/account', 'CustomerController@account');
    Route::post('/change-password', 'CustomerController@change_password');
    //End customer route
});
