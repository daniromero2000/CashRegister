<?php

namespace App\Entities\Users\Repositories;

use App\Entities\Users\User;

/**
 * Class UserRepository
 * @package App\Entities\Users\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
class UserRepository
{

    /**
     * @var User
     */
    protected $user;

    /**
     * LogRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return $this->user->create($data);
    }

}
