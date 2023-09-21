<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Services\CreateUserService;

class CreateUserController extends Controller
{
    public function __construct(
        private CreateUserService $createUserService,
    ) 
    { }

    /**
     * Display a listing of the resource.
     */
    public function execute(): string
    {
        return json_encode($this->createUserService->execute());
    }
}
