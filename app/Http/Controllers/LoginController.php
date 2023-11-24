<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }

    public function authenticate(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return $this->successResponse('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('username', $request->username)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user_name' => $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens->delete();
        return $this->successResponse('logout');
    }
}
