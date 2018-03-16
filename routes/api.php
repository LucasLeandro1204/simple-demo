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

Route::prefix('advertiser')->name('advertiser.')->group(function () {
    Route::get('/', 'AdvertiserController@index')->name('index');
    Route::post('/', 'AdvertiserController@store')->name('store');
    Route::put('/{advertiser}', 'AdvertiserController@update')->name('update');
    Route::delete('/{advertiser}', 'AdvertiserController@delete')->name('destroy');
});

Route::prefix('advertisement')->name('advertisement.')->group(function () {
    Route::post('/', 'AdvertisementController@store')->name('store');
    Route::put('/{advertisement}', 'AdvertisementController@update')->name('update');
});
