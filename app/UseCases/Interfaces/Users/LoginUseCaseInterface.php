<?php

namespace App\UseCases\Interfaces\Users;

interface LoginUseCaseInterface
{
    public function handler(string $email, string $password): array;
}
