<?php

namespace App\Http\Middleware;


use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class JwtMiddleware extends BaseMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid', 'code' => 'TOKEN_INVALID'], 403);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $token = JWTAuth::getToken();
                try {
                    $token = auth()->refresh($token); // might fail
                    $user = auth()->setToken($token)->user();
                    auth()->login($user);
                    return response()->json(['status' => 'Token is Expired', 'code' => 'TOKEN_EXPIRED', "token" => $token], 401);
                } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
                    //token cannot be refreshed, user needs to login again
                    return response()->json(['status' => 'Token is Blacklisted', 'code' => 'TOKEN_BLACKLISTED'], 400);
                }
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['status' => 'Token is Blacklisted', 'code' => 'TOKEN_BLACKLISTED'], 400);
            } else {
                return response()->json(['status' => 'Authorization Token not found', 'code' => 'TOKEN_NOT_FOUND'], 404);
            }
        }

        return $next($request);
    }
}
