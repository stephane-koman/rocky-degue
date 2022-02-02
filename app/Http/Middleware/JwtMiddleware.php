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
                error_log("TokenInvalidException");
                return response()->json(['status' =>'Token is Invalid', 'code' => 'TOKEN_INVALID'], 403);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $token = JWTAuth::getToken();
                error_log($token);
                error_log("TokenExpiredException");
                try {
                    $token = JWTAuth::refresh($token); // might fail
                    JWTAuth::setToken($token);
                    $user = JWTAuth::authenticate($token);
                    return response()->json(['status' =>'Token is Expired', 'code' => 'TOKEN_EXPIRED'], 401);
                } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
                    //token cannot be refreshed, user needs to login again
                    return response()->json(['status' => 'Token is Blacklisted', 'code' => 'TOKEN_BLACKLISTED'], 400);
                }

            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                error_log("TokenBlacklistedException");
                return response()->json(['status' =>'Token is Blacklisted', 'code' => 'TOKEN_BLACKLISTED'], 400);
            } else {
                error_log("Else");
                return response()->json(['status' =>'Authorization Token not found', 'code' => 'TOKEN_NOT_FOUND'], 404);
            }
        }
        return $next($request);
    }
}
