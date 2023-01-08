<?php

use App\Http\Controllers\AdminController;
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
//user
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::get('/danh-muc-san-pham/{categoryid}', 'CategoryProduct@show_category_home');
Route::get('/chi-tiet-san-pham/{bookid}', 'ProductController@details_product');
Route::post('/change_password', 'HomeController@changedPassword');

// books
Route::get('/show_books', 'AdminController@show_all_books');
Route::get('/show_add_books', 'AdminController@show_add_books');

//cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');
Route::post('/login-cart', 'CartController@login_cart');
Route::post('/signin-cart', 'CartController@signin_cart');

//checkout
Route::post('/payment', 'CheckoutController@payment');
//Profile + Ordered
Route::get('/show-profile', 'ProfileController@show_profile');
Route::get('/show-details-ordered/{orderid}', 'ProfileController@show_details_ordered');
Route::post('/load-comment', 'ProfileController@load_comment');
Route::post('/send-comment', 'ProfileController@send_comment');
Route::post('/update-profile', 'ProfileController@update_profile');

//login
Route::post('/dangky', 'HomeController@postDangKy');
Route::post('/dangnhap', 'HomeController@postDangNhap');
Route::get('/dangxuat', 'HomeController@getDangXuat');

// search
Route:: get('/search', 'SearchController@show_search_results');
Route:: post('/get_suggestion', 'SearchController@show_suggestion');




// BEGIN ADMIN
// admin dashboard
Route::get('/admin', 'AdminController@index');
Route::get('/show_dashboard', 'AdminController@showDashBoard');
Route::post('/admin_dashboard','AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

// admin category
Route::get('/add_category', 'CategoryProduct@show_form_add_category');
Route::get('/all_category', 'CategoryProduct@show_all_category');
Route::post('/save_category', 'CategoryProduct@add_category');
Route::get('/delete_category/{categoryid}', 'CategoryProduct@delete_category');
Route::get('/update_category/{categoryid}', 'CategoryProduct@show_form_edit_category');
Route::post('/save_editcategory', 'CategoryProduct@update_category');

// admin nxb
Route::get('/all_nxb', 'NXBController@show_all_NXB');
Route::get('/add_nxb', 'NXBController@show_form_add_NXB');
Route::get('/delete_nxb/{nxbid}', 'NXBController@delete_nxb');
Route::post('/save_nxb', 'NXBController@add_nxb');
Route::get('/update_nxb/{nxbid}', 'NXBController@show_form_edit_NXB');
Route::post('/save_editnxb', 'NXBController@update_NXB');


// admin users
Route::get('/all_users', 'UsersController@show_all_users');
Route::post('/reload_users', 'UsersController@get_all_users');
Route::post('/admin_enable', 'UsersController@enableAdmin');
Route::post('/admin_disable', 'UsersController@disableAdmin');
Route::post('/user_disable', 'UsersController@disableUser');
Route::post('/user_enable', 'UsersController@enableUser');
Route::post('/remove_user', 'UsersController@remove_user');

// admin orders
Route::get('/all_orders', 'OrderController@show_all_orders');
Route::get('/order_detail/{id}', 'OrderController@show_order_details');
Route::post('/order_confirm', 'OrderController@confirm_order');
Route::post('/order_success', 'OrderController@success_order');
Route::post('/order_delete', 'OrderController@delete_order');
Route::get('/order_filter', 'OrderController@filter_orders');
// END ADMIN

