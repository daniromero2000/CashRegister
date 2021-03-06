<?php

namespace App\Entities\Users\Repositories\Interfaces;

use App\Entities\Users\User;

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
