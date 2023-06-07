<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Entities\Users\Repositories
 * @author Daniel Romero - 123romerod@gmail.com
 */
class UserRepository implements UserRepositoryInterface
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
