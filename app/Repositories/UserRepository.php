<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository {
    public function getById(int $id): User;
    public function create(User $user): User;
}