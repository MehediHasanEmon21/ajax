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



Route::get('register/user','TestController@show_register')->name('register.user');
Route::post('register/user','TestController@user_store')->name('user.store');
Route::get('login/user','TestController@login')->name('login.user');
Route::post('login/user','TestController@login_check')->name('login.check');
Route::get('home/page','TestController@index')->name('index.user');
Route::get('user/logout','TestController@logout')->name('user.logout');

Route::get('product','TestController@product');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
