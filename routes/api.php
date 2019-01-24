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

Route::prefix('lights')->group(function() {
    Route::get('/on', 'LightsController@on');
    Route::get('/off', 'LightsController@off');
    Route::get('/check', 'LightsController@check');
});