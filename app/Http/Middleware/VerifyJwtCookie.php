<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyJwtCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($_COOKIE['access-token'])) {
            try {
                $payload = JWT::decode($_COOKIE['access-token'], new Key(config('jwt.key'), config('jwt.alg')));

                Auth::loginUsingId($payload->sub);

                return $next($request);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return redirect()->route('login');
    }
}
