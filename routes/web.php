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
    return view('main');
});

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/register', 'RegisterController@register');
    Route::get('/logout', 'LoginController@logout');
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
});
Route::get('currencies/{currency}', 'CurrencyController@setCurrency')->name('currency.set');
Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@index')->name('products.list');
    Route::post('/{product}/addToCart', 'ProductController@addToCart');
    Route::get('/cart', 'ProductController@cart')->name('cart.detail');
});
Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index')->name('categories.list');
});
