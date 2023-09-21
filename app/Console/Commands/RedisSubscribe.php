<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Services\SendEmailCalledWelcomeService;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a redis channel';

    public function __construct(
        private SendEmailCalledWelcomeService $sendEmailCalledWelcomeService,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Redis::subscribe('users-backend-php.user-created', function(string $message) {
            $userJson = json_decode($message);
            $this->sendEmailCalledWelcomeService->execute($userJson->userId);
        });
    }
}
