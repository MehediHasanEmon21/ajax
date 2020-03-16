<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/fetch','TestController@fetch');
Route::post('/post/add','TestController@post_add');
Route::get('/fetch/post','TestController@fetch_post');
Route::get('/fetch/user','TestController@fetch_user');
Route::get('/follow/unfollow','TestController@follow_unfollow');
Route::post('/add/comment','TestController@add_comment');
Route::get('/fetch/comment','TestController@fetch_comment');



