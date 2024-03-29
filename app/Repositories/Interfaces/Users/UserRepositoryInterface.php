<?php

namespace App\Repositories\Interfaces\Users;


use App\Models\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Entities\Users\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User;
}
