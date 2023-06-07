<?php

namespace App\Providers;

use App\UseCases\CashRegisters\CheckStatusUseCase;
use App\UseCases\CashRegisters\CreateMoneyBaseUseCase;
use App\UseCases\CashRegisters\WithdrawAllMoneyUseCase;
use App\UseCases\Interfaces\CashRegisters\CheckStatusUseCaseInterface;
use App\UseCases\Interfaces\CashRegisters\CreateMoneyBaseUseCaseInterface;
use App\UseCases\Interfaces\CashRegisters\WithdrawAllMoneyUseCaseInterface;
use App\UseCases\Interfaces\Payments\SavePaymentUseCaseInterface;
use App\UseCases\Interfaces\TransactionLogs\TransactionLogUseCaseInterface;
use App\UseCases\Interfaces\Users\LoginUseCaseInterface;
use App\UseCases\Interfaces\Users\RegisterUserUseCaseInterface;
use App\UseCases\Interfaces\Users\UserUseCaseInterface;
use App\UseCases\Payments\SaveSavePaymentUseCase;
use App\UseCases\TransactionLogs\TransactionLogUseCase;
use App\UseCases\Users\LoginUseCase;
use App\UseCases\Users\RegisterUserUseCase;
use App\UseCases\Users\UserUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    protected array $classes = [
        // Auth
        UserUseCaseInterface::class => UserUseCase::class,
        LoginUseCaseInterface::class => LoginUseCase::class,
        RegisterUserUseCaseInterface::class => RegisterUserUseCase::class,

        // CashRegister
        CreateMoneyBaseUseCaseInterface::class => CreateMoneyBaseUseCase::class,
        CheckStatusUseCaseInterface::class => CheckStatusUseCase::class,
        WithdrawAllMoneyUseCaseInterface::class => WithdrawAllMoneyUseCase::class,

        // Payments
        TransactionLogUseCaseInterface::class => TransactionLogUseCase::class,
        SavePaymentUseCaseInterface::class => SaveSavePaymentUseCase::class
    ];

    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
