<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;

class CreateUserService {
    public function __construct(
        private UserRepository $userRepository,
    ){}

    public function execute(string $name, string $password, string $email): User {
        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;

        $this->userRepository->create($user);
        
        $message = json_encode([
            'userId' => $user->id
        ]);

        Redis::publish('UserCreated', $message);
        
        return $user;
    }
}