<?php


namespace App\Providers;


use App\Entities\Users\UseCases\Interfaces\UserUseCaseInterface;
use App\Entities\Users\UseCases\UserUseCase;
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
    }
}
