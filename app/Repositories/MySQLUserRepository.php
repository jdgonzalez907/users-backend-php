<?php

namespace App\Repositories;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

final class MySQLUserRepository implements UserRepository
{
    public function getById(int $id): User 
    {
        return User::find($id);
    }

    public function create(User $user): User 
    {
        $user->save();

        return $user;
    }
}
