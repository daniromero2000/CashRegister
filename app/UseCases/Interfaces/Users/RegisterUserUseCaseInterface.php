<?php

namespace App\UseCases\Interfaces\Users;

interface RegisterUserUseCaseInterface
{
    public function handler(array $data): array;
}
