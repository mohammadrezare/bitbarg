<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use JWTAuth;
use App\Http\Requests\Api\RegisterJWTAuthRequest;
use App\Http\Requests\Api\LoginJWTAuthRequest;

class AuthController extends Controller
{

    public function register(RegisterJWTAuthRequest $request)
    {
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        auth()->login($user);

        return $this->respondWithToken($user);
    }

    public function login(LoginJWTAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::find(auth()->user()->id);

        return $this->respondWithToken($user);
    }

    protected function respondWithToken($user)
    {
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token_type' => 'bearer',
            'token' => $token,
        ]);
    }

}
