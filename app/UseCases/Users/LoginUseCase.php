<?php

namespace App\UseCases\Users;

use App\Exceptions\Users\UserNotFoundException;
use App\UseCases\Interfaces\Users\LoginUseCaseInterface;
use JetBrains\PhpStorm\ArrayShape;
use JWTAuth;

class LoginUseCase implements LoginUseCaseInterface
{
    #[ArrayShape([
        'access_token' => "string",
        'token_type' => "string"
    ])]
    public function handler(string $email, string $password): array
    {
        $userData = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = JWTAuth::attempt($userData)) {
            throw new UserNotFoundException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
