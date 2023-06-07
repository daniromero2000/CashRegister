<?php

namespace App\UseCases\Interfaces\Users;

use Illuminate\Http\JsonResponse;

/**
 * Interface UserUseCaseInterface
 * @package App\Entities\Users\UseCases\Interfaces
 */
interface UserUseCaseInterface
{
    /**
     * @return bool
     */
    public function logout(): bool;
}
