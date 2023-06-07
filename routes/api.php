<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::namespace('Auth')->group(function () {
        Route::post('login', 'LoginController')->name('login');
        Route::post('register', 'RegisterController')->name('register');

        Route::group(['middleware' => ['api']], function () {
            Route::get('logout', 'LogoutController')->name('logout');
        });
    });
});

Route::group(['prefix' => 'merqueo-cash', 'middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'cash-register'], function () {
        Route::namespace('CashRegisters')->group(function () {
            Route::post('/create', 'SaveMoneyBaseController')
                ->name('cashRegister.create');

            Route::get('/check-status', 'CheckStatusController')
                ->name('cashRegister.getStatus');

            Route::get('/withdraw-all-money', 'WithdrawAllMoneyController')
                ->name('cashFlow.withdrawAllMoney');
        });
    });

    Route::group(['prefix' => 'transactions'], function () {
        Route::namespace('TransactionLogs')->group(function () {
            Route::get('/', 'TransactionLogController@getLogs')
                ->name('transactionLog.getLogs');

            Route::get('/status/{date}', 'TransactionLogController@getStatusByDate')
                ->name('transactionLog.getStatusByDate');
        });
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::namespace('Payments')->group(function () {
            Route::post('/create', 'SavePaymentController')
                ->name('payment.create');
        });
    });
});
