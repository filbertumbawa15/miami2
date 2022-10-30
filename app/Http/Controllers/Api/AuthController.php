<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        dd(Hash::make("harusbesar303"));
        $user = User::where('username', $request->username)->first();

        if (Hash::check($request->password, $user->password)) {
            $token = $this->generateToken($user);

            if ($token) {
                return response([
                    'user' => $user,
                    'token' => $token,
                ]);
            }
        } else {
            return response([
                'message' => 'Authentication failed! Please recheck your password'
            ], 401);
        }
    }

    public function generateToken(User $user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        $token = JWT::encode($payload, config('jwt.key'), config('jwt.alg'));

        return $token;
    }
}
