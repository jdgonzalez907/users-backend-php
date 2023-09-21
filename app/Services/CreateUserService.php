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

    public function execute(): User {
        $user = new User();
        $user->name = 'something';
        $user->password = Hash::make('userpassword');
        $num = strval(rand(10, 2000));
        $user->email = "user$num@user.com";

        $this->userRepository->create($user);
        
        $message = json_encode([
            'userId' => $user->id
        ]);

        Redis::publish('UserCreated', $message);
        
        return $user;
    }
}