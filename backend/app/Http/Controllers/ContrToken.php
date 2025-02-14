<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Exception;

class ContrToken extends Controller
{
    public function generarToken () {
        try {
            $customClaims = [
                'iss' => config('app.url'),
                'iat' => time(),         // indica el momento en que el token fue generado
                'exp' => time() + 300,   // time in second  (desde el tiempo actual + 300s)
                'nbf' => time(),         // indica apartir de que momento el token sera valido
                'sub' => 'api-client',   // nombre del cliente que utilizara el jwt
                'jti' => uniqid()        // Es el identificador del token
            ];  

            /** Se carga las configuraciones */
            $payload = JWTFactory::customClaims($customClaims)->make();
            $token = JWTAuth::encode($payload)->get();
            return response()->json(['token' => $token]);

        } catch (Exception $e){
            return $e->getMessage();
        }       
    }

    public function EsvalidoToken () {
        try {
            //* ** Verificar token
            JWTAuth::parseToken()->checkOrFail();  // Verifica si el token es válido

            // Si llegamos aquí, el token es válido
            return response()->json(['message' => 'Token válido']);
        } catch (TokenExpiredException $e) {
            return response()->json("Token has expired.");
        } catch (TokenInvalidException $e) {
            return response()->json("Token is invalid.");            
        } catch (JWTException $e) {            
            return response()->json("Token is missing or malformed.");
        }
    }
     
}
