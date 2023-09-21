<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class SendEmailCalledWelcomeService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {}

    public function execute(int $userId): User {
        $user = $this->userRepository->getById($userId);

        if ($user == null) {
            logger("Error sending welcome email, user not found");
        } else {
            logger("Sending welcome email to user with id [$user->id]");
        }

        return $user;
    }
}

