<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;
    public function createUser(UserRequest $request)
    {
        $user = $request->validated();
        $user['password'] = Hash::make($user['password']);

        return $this->successResponse([
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }

}
