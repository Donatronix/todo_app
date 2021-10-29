<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

/**
 * Class UserRepository
 *
 * @package \App\Repositories\Eloquent\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
