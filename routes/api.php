<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login')->name('login_route');
    Route::post('logout', 'Api\AuthController@logout')->name('log_out')->middleware('JWTAuthentication');
    Route::post('refresh', 'Api\AuthController@refresh')->name('refresh_route')->middleware('JWTAuthentication');
    Route::post('me', 'Api\AuthController@me')->middleware('JWTAuthentication');
});

