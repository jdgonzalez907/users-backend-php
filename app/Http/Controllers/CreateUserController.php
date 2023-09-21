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
    public function execute(Request $request): string
    {
        $name = $request->query("name");
        $password = $request->query("password");
        $email = $request->query("email");
        
        $user = $this->createUserService->execute($name, $password, $email);

        return json_encode($user);
    }
}
