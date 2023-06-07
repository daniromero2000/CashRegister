<?php

namespace App\Providers;

use App\UseCases\CashRegisters\CashRegisterUseCase;
use App\UseCases\Interfaces\CashRegisters\CashRegisterUseCaseInterface;
use App\UseCases\Interfaces\Payments\PaymentUseCaseInterface;
use App\UseCases\Interfaces\TransactionLogs\TransactionLogUseCaseInterface;
use App\UseCases\Interfaces\Users\UserUseCaseInterface;
use App\UseCases\Payments\PaymentUseCase;
use App\UseCases\TransactionLogs\TransactionLogUseCase;
use App\UseCases\Users\UserUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserUseCaseInterface::class,
            UserUseCase::class
        );

        $this->app->bind(
            CashRegisterUseCaseInterface::class,
            CashRegisterUseCase::class
        );

        $this->app->bind(
            TransactionLogUseCaseInterface::class,
            TransactionLogUseCase::class
        );

        $this->app->bind(
            PaymentUseCaseInterface::class,
            PaymentUseCase::class
        );
    }
}
