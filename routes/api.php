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

Route::group(['prefix' => 'auth'], function () {
    Route::namespace('Api')->group(function () {
        Route::namespace('Auth')->group(function () {
            Route::post('login', 'AuthController@login')->name('login');
            Route::post('signup', 'AuthController@signUp')->name('signup');

            Route::group(['middleware' => ['api']], function () {
                Route::get('logout', 'AuthController@logout')->name('logout');
            });
        });

    });
});
