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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});

Route::namespace('API')->name('api')->group(function() {
    Route::prefix('/products')->group(function() {
        Route::get('/', 'ProductController@index')->name('products');
        Route::get('/{id}', 'ProductController@show')->name('product_only');

        Route::post('/', 'ProductController@store')->name('products_store');
        Route::put('/{id}', 'ProductController@update')->name('products_uptade');
    });

    Route::prefix('/demanded')->group(function() {
        Route::get('/', 'DemandedController@index')->name('demanded');
        // Route::get('/{id}', 'ProductController@show')->name('product_only');

        Route::post('/', 'DemandedController@store')->name('demanded_created');
        // Route::put('/{id}', 'ProductController@update')->name('products_uptade');
    });
});


