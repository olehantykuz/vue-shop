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

Route::group(['prefix' => 'admin'], function () {
    Route::get('currencies/{currency}', 'CurrencyController@setCurrency');
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index');
    });
});
