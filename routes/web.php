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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
// Users
    Route::get('/contacts', 'UserController@getContacts');
    Route::resource('users', 'UserController');
    Route::resource('breakfasts', 'UserBreakfastController', ['only' => ['show', 'edit', 'update']]);
    Route::resource('menu-settings', 'MenuSettingController', ['only' => ['index', 'edit', 'update']]);

    Route::get('/cancel-breakfast', 'UserBreakfastController@cancelBreakfastView');
});

Route::get('/test', function () {
    return view('user.contacts');
});
