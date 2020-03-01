<?php

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

Route::get('file-upload','FileUploadController@index');
Route::get('show/password','TestController@show_password_field');

Route::get('product_load_by_price','TestController@product_load_by_price_view');
