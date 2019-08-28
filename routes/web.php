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

Route::get('logout', 'Auth\LoginController@logout');
Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index');

    // Mobil Routes
    Route::group(['prefix' => 'mobil'], function () {
        Route::match(['get', 'post'], '/', 'MobilController@index');
        Route::get('create', 'MobilController@create');
        Route::post('store', 'MobilController@store');
        Route::get('edit/{id}', 'MobilController@edit');
        Route::post('update/{id}', 'MobilController@update');
        Route::delete('delete/{id}', 'MobilController@destroy');
    });

    // Penjualan Routes
    Route::group(['prefix' => 'penjualan'], function () {
        Route::match(['get', 'post'], '/', 'PenjualanController@index');
        Route::get('create', 'PenjualanController@create');
        Route::post('store', 'PenjualanController@store');
        Route::post('get-mobil', 'PenjualanController@getMobil');
    });
});