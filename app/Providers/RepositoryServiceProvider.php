<?php

namespace App\Providers;

use App\Repositories\CashRegisters\CashRegisterRepository;
use App\Repositories\Interfaces\CashRegisters\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\Payments\PaymentRepositoryInterface;
use App\Repositories\Interfaces\TransactionLogs\TransactionLogRepositoryInterface;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use App\Repositories\Payments\PaymentRepository;
use App\Repositories\TransactionLogs\TransactionLogRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class
        );

        $this->app->bind(
            CashRegisterRepositoryInterface::class,
            CashRegisterRepository::class
        );

        $this->app->bind(
            TransactionLogRepositoryInterface::class,
            TransactionLogRepository::class
        );
    }

}
