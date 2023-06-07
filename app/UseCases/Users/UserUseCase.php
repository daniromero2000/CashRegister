<?php

namespace App\UseCases\Users;

use App\UseCases\Interfaces\Users\UserUseCaseInterface;
use JWTAuth;

class UserUseCase implements UserUseCaseInterface
{
    /**
     * @return bool
     */
    public function logout(): bool
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return true;
    }
}
