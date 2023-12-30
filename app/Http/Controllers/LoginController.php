<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
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
        $user->token =  $user->createToken('auth_token')->plainTextToken;

        return  $this->successResponse(UserResource::make($user));
    }

    public function logout()
    {
        Auth::user()->tokens->delete();
        return $this->successResponse('logout');
    }
}
