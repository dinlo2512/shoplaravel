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
//frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/trang-chu','HomeController@login_customer');
Route::post('/trang-chuu','HomeController@loginCustomer');
Route::get('/home-all-product','HomeController@allProduct');
Route::get('/logout-checkout','HomeController@logout');
Route::post('/tim-kiem','HomeController@search');

//Danh mục sản phẩm
Route::get('/danh-muc-sp/{category_id}','CategoryProduct@show_category');
Route::get('/thuong-hieu-sp/{brand_id}','BrandProduct@show_brand');
Route::get('/chi-tiet-san-pham/{product_id}','Product@detail_product');



//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/dashboard','AdminController@dashboard');
Route::get('/manage-order','AdminController@manageOrder');
Route::get('/view-order/{orderId}','AdminController@viewOrder');



//CategoryProduct
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_id}','CategoryProduct@active_category_product');
Route::get('/edit-category-product/{category_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_id}','CategoryProduct@delete_category_product');


Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_id}','CategoryProduct@update_category_product');

//BrandProduct
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_id}','BrandProduct@active_brand_product');
Route::get('/edit-brand-product/{brand_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_id}','BrandProduct@delete_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','Product@add_product');
Route::get('/all-product','Product@all_product');

Route::get('/unactive-product/{product_id}','Product@unactive_product');
Route::get('/active-product/{product_id}','Product@active_product');
Route::get('/edit-product/{product_id}','Product@edit_product');
Route::get('/delete-product/{product_id}','Product@delete_product');

Route::post('/save-product','Product@save_product');
Route::post('/update-product/{product_id}','Product@update_product');

//Cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/saveCart','CartController@saveCart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-cart','CartController@update_cart');
//CheckOut
Route::get('/login-checkout','CheckController@login_checkout');
Route::get('/login-checkoutt','CheckController@loginCheckout');
Route::post('/add-customer','CheckController@add_customer');
Route::post('/add-customerr','CheckController@addCustomer');
Route::get('/checkout','CheckController@checkout');

Route::post('/save-checkout-customer','CheckController@save_checkout_customer');
Route::get('/payment','CheckController@payment');
Route::post('/order-place','CheckController@orderPlace');
Route::get('/end','CheckController@end');
