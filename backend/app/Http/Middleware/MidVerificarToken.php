<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class MidVerificarToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {    
            JWTAuth::parseToken()->checkOrFail();  // Verifica si el token es válido   
        } catch (TokenExpiredException $e) {
            return response()->json("Token has expired.");
        } catch (TokenInvalidException $e) {
            return response()->json("Token is invalid.");            
        } catch (JWTException $e) {            
            return response()->json("Token is missing or malformed.");
        }
        return $next($request);
    }
}
