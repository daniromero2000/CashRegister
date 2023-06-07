<?php

namespace App\UseCases\Users;

use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use App\UseCases\Interfaces\Users\RegisterUserUseCaseInterface;
use JWTAuth;

class RegisterUserUseCase implements RegisterUserUseCaseInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function handler(array $data): array
    {
        $this->userRepository->createUser($data);

        // TODO: Agregar retorno de token
        return [];
    }
}
