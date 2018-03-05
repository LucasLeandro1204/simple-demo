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

Route::prefix('advertiser')->group(function () {
    Route::get('/', 'AdvertiserController@index')->name('advertiser.index');
    Route::post('/', 'AdvertiserController@store')->name('advertiser.store');
    Route::put('/{advertiser}', 'AdvertiserController@update')->name('advertiser.update');
    Route::delete('/{advertiser}', 'AdvertiserController@delete')->name('advertiser.destroy');
});
