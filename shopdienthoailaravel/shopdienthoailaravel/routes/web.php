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
//View
use App\Http\Controllers\HomeController; 
// More Options
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');




//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{slug_category_product}','App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_slug}','App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_slug}','App\Http\Controllers\ProductController@details_product');



//Admin 
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');


// Thống kê admin 
Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');
Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');
Route::get('/order-date','App\Http\Controllers\AdminController@order_date');

//Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');
Route::post('/arrange-catergory','App\Http\Controllers\CategoryProduct@arrange_catergory');
Route::post('/product-tabs','App\Http\Controllers\CategoryProduct@product_tabs');





// IMPORT & EXPORT EXCEL 
// CategoryProduct
Route::post('/export-csv','App\Http\Controllers\ExcelController@export_csv');
Route::post('/import-csv','App\Http\Controllers\ExcelController@import_csv');

// Manage Order
Route::post('/export-manage-order','App\Http\Controllers\ExcelController@export_manage_order');
Route::post('/import-manage-order','App\Http\Controllers\ExcelController@import_manage_order');
// Coupon
Route::post('/export-list-coupon','App\Http\Controllers\ExcelController@export_list_coupon');
Route::post('/import-list-coupon','App\Http\Controllers\ExcelController@import_list_coupon');
// Brand
Route::post('/export-brand','App\Http\Controllers\ExcelController@export_brand');
Route::post('/import-brand','App\Http\Controllers\ExcelController@import_brand');




//Brand Product
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');

//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');

Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');


Route::get('/tag/{product_tag}','App\Http\Controllers\ProductController@tag');

Route::post('/quickview','App\Http\Controllers\ProductController@quickview');
Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::post('/reply-comment','App\Http\Controllers\ProductController@reply_comment');
Route::get('/comment','App\Http\Controllers\ProductController@list_comment');
Route::get('/delete-comment/{comment_id}','App\Http\Controllers\ProductController@delete_comment');

// cart
Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');

Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@delete_product');
Route::get('/del-all-product','App\Http\Controllers\CartController@delete_all_product');


Route::get('/show-cart','App\Http\Controllers\CartController@show_cart_menu');


// Checkout
Route::get('/login-checkout','App\Http\Controllers\CheckOutController@login_checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckOutController@logout_checkout');
Route::post('/add-customer','App\Http\Controllers\CheckOutController@add_customer');
Route::post('/order-place','App\Http\Controllers\CheckOutController@order_place');
Route::post('/login-customer','App\Http\Controllers\CheckOutController@login_customer');
Route::get('/show-checkout','App\Http\Controllers\CheckOutController@show_checkout');
Route::get('/payment','App\Http\Controllers\CheckOutController@payment');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckOutController@save_checkout_customer');

Route::post('/select-delivery-home','App\Http\Controllers\CheckOutController@select_delivery_home');
Route::post('/calculate-fee','App\Http\Controllers\CheckoutController@calculate_fee');
Route::get('/del-fee','App\Http\Controllers\CheckoutController@del_fee');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');

// Coupon
Route::post('/check-coupon','App\Http\Controllers\CartController@check_coupon');
Route::get('/unset-coupon','App\Http\Controllers\CouponController@unset_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');

// Banner
Route::get('/manage-slider','App\Http\Controllers\SliderController@manage_slider');
Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','App\Http\Controllers\SliderController@delete_slide');
Route::post('/insert-slider','App\Http\Controllers\SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','App\Http\Controllers\SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','App\Http\Controllers\SliderController@active_slide');

//Manager Order
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('/delete-order/{order_code}','App\Http\Controllers\OrderController@order_code')->middleware('checkRole');;
Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');

Route::get('/history','App\Http\Controllers\OrderController@history');
Route::get('/view-history-order/{order_code}','App\Http\Controllers\OrderController@view_history_order');
Route::post('/huy-don-hang','App\Http\Controllers\OrderController@huy_don_hang');


// Send Mail
Route::get('/send-mail','App\Http\Controllers\HomeController@send_mail');
Route::get('/send-coupon','App\Http\Controllers\MailController@send_coupon');
Route::get('/quen-mat-khau','App\Http\Controllers\MailController@quen_mat_khau');
Route::get('/update-new-pass','App\Http\Controllers\MailController@update_new_pass');
Route::post('/recover-pass','App\Http\Controllers\MailController@recover_pass');
Route::post('/reset-new-pass','App\Http\Controllers\MailController@reset_new_pass');





// Authentication roles
Route::get('register-auth','App\Http\Controllers\AuthController@register_auth');
Route::post('register','App\Http\Controllers\AuthController@register');
Route::get('login-auth','App\Http\Controllers\AuthController@login_auth');
Route::get('logout-auth','App\Http\Controllers\AuthController@logout_auth');
Route::post('login','App\Http\Controllers\AuthController@login');




// Route::get('users','App\Http\Controllers\UserController@index');
Route::get('users','App\Http\Controllers\UserController@index')->middleware('checkRole');
Route::get('add-users','App\Http\Controllers\UserController@add_users')->middleware('checkRole');
// Route::get('users','App\Http\Controllers\UserController@index');
// Route::get('add-users','App\Http\Controllers\UserController@add_users');
Route::get('delete-user/{admin_id}','App\Http\Controllers\UserController@delete_user');

Route::post('store-users','App\Http\Controllers\UserController@store_users');

// Route::post('assign-roles','App\Http\Controllers\UserController@assign_roles');
Route::post('/assign-roles', 'App\Http\Controllers\UserController@assignRoles')->name('assign.roles');

Route::get('all-customer','App\Http\Controllers\UserController@all_customer');
Route::get('delete-customer/{customer_id}','App\Http\Controllers\UserController@delete_customer')->middleware('checkRole');

//Danh mục Bài viết

Route::get('/add-category-post','App\Http\Controllers\CategoryPost@add_category_post');
Route::get('/all-category-post','App\Http\Controllers\CategoryPost@all_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPost@edit_category_post');
Route::post('/save-category-post','App\Http\Controllers\CategoryPost@save_category_post');
Route::get('/danh-muc-bai-viet-pham/{cate_post_slug}','App\Http\Controllers\CategoryPost@danh_muc_bai_viet');
Route::post('/update-category-post/{cate_id}','App\Http\Controllers\CategoryPost@update_category_post');
Route::get('/delete-category-post/{category_post_id}','App\Http\Controllers\CategoryPost@delete_category_post');


//Post
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');

//Bài viết
Route::get('/danh-muc-bai-viet/{post_slug}','App\Http\Controllers\PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','App\Http\Controllers\PostController@bai_viet');


// Gallery
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('/select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('/update-gallery','App\Http\Controllers\GalleryController@update_gallery');



// Liên hệ
Route::get('/lien-he','App\Http\Controllers\ContactController@lien_he');


//Thanh toán online

Route::post('/onepay_payment','App\Http\Controllers\CheckOutController@onepay_payment');
Route::post('/vnpay_payment','App\Http\Controllers\CheckOutController@vnpay_payment');
