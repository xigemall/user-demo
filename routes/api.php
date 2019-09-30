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

Route::post('/register','Api\RegisterController@register');
Route::post('/login','Api\LoginController@login');

Route::middleware('auth:api')->namespace('Api')->group(function(){
    // 退出登录
    Route::post('/logout','LoginController@logout');
});

