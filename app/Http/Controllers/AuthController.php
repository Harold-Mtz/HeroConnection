<?php

namespace App\Http\Controllers;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        Log::info($request);
        $credentials = $request->only('email', 'password');

        if(!$token=auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        Log::info($token);

        return $this->successResponse(
            ['token' => $token,
              'token_type' => 'Bearer',
            ],
            'User logged in successfully'

        );
    }

}
