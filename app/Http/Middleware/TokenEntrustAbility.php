<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class TokenEntrustAbility extends BaseMiddleware
{
    public function handle($request, Closure $next, $roles, $permissions, $validateAll = false)
    {

        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response()->json(['token absent'], 400);
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if($e instanceof TokenExpiredException) {
                return response()->json(['token_expired'], 400);
            }
            else if($e instanceof JWTException) {
                return response()->json(['token_invalid'], 400);
            }
        }

        if (! $user) {
            return response()->json(['user not found '], 404);
        }

        if (!$request->user()->ability(explode('|', $roles), explode('|', $permissions), array('validate_all' => $validateAll))) {
            // this return statement stops and checks the validated user from jwt for the ability role
            return response()->json(['insufficient permission'], 404);
        }

        return $next($request);
    }
}
