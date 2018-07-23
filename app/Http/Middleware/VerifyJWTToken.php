<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (JWTException $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return VerifyJWTTokenService::getCustomFailMessageByServer('token_expired');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return VerifyJWTTokenService::getCustomFailMessageByClient('token_invalid');
            } else {
                return VerifyJWTTokenService::getCustomFailMessageByClient('token_is_required');
            }
        }
        return $next($request);
    }
}

class VerifyJWTTokenService
{
    public static function getCustomFailMessageByServer($message)
    {
        return response()->json([
            'error_code' => '0002',
            'error_message' => $message
        ]);
    }

    public static function getCustomFailMessageByClient($message)
    {
        return response()->json([
            'error_code' => '0001',
            'error_message' => $message
        ]);
    }
}