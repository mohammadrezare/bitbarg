<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:users,email',
            'password' => 'required|max:8',
        ]);
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        auth()->login($user);

        return $this->respondWithToken($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:100',
            'password' => 'required|max:200',
        ]);

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
