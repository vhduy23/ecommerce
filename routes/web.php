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
Route::get('/', 'App\Http\Controllers\FrontController@home');



//Auth customer
Route::get('/login', 'App\Http\Controllers\UserController@getCusLogin')->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@postCusLogin');

Route::get('/register', 'App\Http\Controllers\UserController@getCusRegister');
Route::post('/register', 'App\Http\Controllers\UserController@postCusRegister');

Route::get('/logout-customer', 'App\Http\Controllers\UserController@getLogoutCus');



// Auth admin
Route::get('se-admin', 'App\Http\Controllers\UserController@getLogin');
Route::post('ad-auth', 'App\Http\Controllers\UserController@postLogin');
Route::get('/logout', 'App\Http\Controllers\UserController@getLogout');



// page action
Route::post('/them-san-pham', 'App\Http\Controllers\FrontController@add_item');
Route::post('/dat-hang', 'App\Http\Controllers\FrontController@order');
Route::post('/cap-nhat-san-pham', 'App\Http\Controllers\FrontController@edit_item');
Route::post('/cap-nhat-phi-ship', 'App\Http\Controllers\FrontController@update_ship');
Route::get('/xoa-san-pham/{rowId}', 'App\Http\Controllers\FrontController@delete_item');
Route::post('/nhan-email-lien-he', 'App\Http\Controllers\FrontController@subEmail');
// Route::post('/ve-chung-toi', 'App\Http\Controllers\FrontController@about');


Route::get('{slug}.html','App\Http\Controllers\FrontController@slugHtml');
Route::get('{slug?}','App\Http\Controllers\FrontController@slug');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function ($middleware) {
    //welcome to admin 
    Route::get('/home', 'App\Http\Controllers\BackController@home');
    //ckeditor
    Route::post('/upload', 'App\Http\Controllers\BackController@uploadImage')->name('ckeditor.upload');
    //staff
    Route::group(['prefix' => 'staff'], function(){

        Route::get('profile', 'App\Http\Controllers\back\StaffController@staff_profile');
        Route::post('profile', 'App\Http\Controllers\back\BackController@staff_profile_post');

        Route::get('list', 'App\Http\Controllers\back\StaffController@staff_list');
        Route::get('add', 'App\Http\Controllers\back\StaffController@staff_add');
        Route::post('add', 'App\Http\Controllers\back\StaffController@staff_add_post');
        Route::get('edit/{id}', 'App\Http\Controllers\back\StaffController@staff_edit');
        Route::post('edit/{id}', 'App\Http\Controllers\back\StaffController@staff_edit_post');
        Route::get('delete/{id}', 'App\Http\Controllers\back\StaffController@staff_delete');
        Route::post('filter', 'App\Http\Controllers\back\StaffController@staff_filter');
    });

    //system
        Route::get('system', 'App\Http\Controllers\back\SystemController@system');
        Route::post('system', 'App\Http\Controllers\back\SystemController@system_post');

    //social
    Route::group(['prefix'=>'social'], function(){
        Route::get('list', 'App\Http\Controllers\back\SocialController@social_list');
        Route::get('add', 'App\Http\Controllers\back\SocialController@social_add');
        Route::post('add', 'App\Http\Controllers\back\SocialController@social_add_post');
        Route::get('edit/{id}', 'App\Http\Controllers\back\SocialController@social_edit');
        Route::post('edit/{id}', 'App\Http\Controllers\back\SocialController@social_edit_post');
        Route::get('delete/{id}', 'App\Http\Controllers\back\SocialController@social_delete');
        Route::post('delete/{id}', 'App\Http\Controllers\back\SocialController@social_delete_post');
    });

    Route::group(['prefix' => 'shopletter'], function(){
        Route::get('list', 'App\Http\Controllers\BackController@shopletter_list');
        Route::get('edit/{id}', 'App\Http\Controllers\BackController@shopletter_edit');
		Route::post('edit/{id}', 'App\Http\Controllers\BackController@shopletter_edit_post');
		Route::get('delete/{id}', 'App\Http\Controllers\BackController@shopletter_delete');
    });

    //category
        Route::group(['prefix'=> 'category'], function(){
            Route::get('list', 'App\Http\Controllers\back\CategoryController@category_list');
            Route::get('add', 'App\Http\Controllers\back\CategoryController@category_add');
            Route::post('add', 'App\Http\Controllers\back\CategoryController@category_add_post');
            Route::get('edit/{id}', 'App\Http\Controllers\back\CategoryController@category_edit');
            Route::post('edit/{id}', 'App\Http\Controllers\back\CategoryController@category_edit_post');
            Route::get('delete/{id}', 'App\Http\Controllers\back\CategoryController@category_delete');
            Route::post('delete/{id}', 'App\Http\Controllers\back\CategoryController@category_delete_post');
        });

    //slider
    Route::group(['prefix'=>'slider'], function(){
        Route::get('list', 'App\Http\Controllers\back\SlideController@slider_list');
        Route::get('add', 'App\Http\Controllers\back\SlideController@slider_getadd');
        Route::post('add', 'App\Http\Controllers\back\SlideController@slider_add');
        Route::get('edit/{id}', 'App\Http\Controllers\back\SlideController@slider_getedit');
        Route::post('edit/{id}', 'App\Http\Controllers\back\SlideController@slider_edit');
        Route::get('delete/{id}', 'App\Http\Controllers\back\SlideController@slider_getedit');
        Route::post('delete/{id}', 'App\Http\Controllers\back\SlideController@slider_delete');
    });

    //product
    Route::group(['prefix' => 'product'], function(){
		Route::get('list', 'App\Http\Controllers\back\ProductController@product_list');
		Route::get('add', 'App\Http\Controllers\back\ProductController@product_getadd');
		Route::post('add', 'App\Http\Controllers\back\ProductController@product_add');
		Route::get('edit/{id}', 'App\Http\Controllers\back\ProductController@product_getedit');
		Route::post('edit/{id}', 'App\Http\Controllers\back\ProductController@product_edit');
		Route::get('delete/{id}', 'App\Http\Controllers\back\ProductController@product_delete');
        
		Route::post('sort/{id}', 'App\Http\Controllers\back\ProductController@product_update_sort');
		Route::post('deleteImageProduct', 'App\Http\Controllers\back\ProductController@deleteImageProduct');
        
	});

	// page 
	Route::group(['prefix' => 'page'], function(){
		Route::get('list', 'App\Http\Controllers\back\PageController@page_list');
		Route::get('edit/{id}', 'App\Http\Controllers\back\PageController@page_edit');
		Route::post('edit/{id}', 'App\Http\Controllers\back\PageController@page_edit_post');
	}); 

    // order 
	Route::group(['prefix' => 'order'], function(){
		Route::get('list', 'App\Http\Controllers\back\OrderController@order_list');
		Route::get('edit/{id}', 'App\Http\Controllers\back\OrderController@order_edit');
		Route::post('edit/{id}', 'App\Http\Controllers\back\OrderController@order_edit_post');
	}); 

});
Route::group(['refix' => 'customer', 'middleware' => 'auth'], function($middleware) { 


});
