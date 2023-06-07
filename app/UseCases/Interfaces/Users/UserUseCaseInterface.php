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
     * @param array $data
     * @return JsonResponse
     */
    public function createUser(array $data): JsonResponse;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function loginUser(array $data): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function logoutUser(): JsonResponse;
}
