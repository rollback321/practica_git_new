<?php

namespace App\Http\Responses;
/** Permite estandarizar las respuestas del servidor al cliente (estador 200, 400, 500) */
class ApiResponse
{
    /**
     * Create a new class instance.
     */
    public static function success ($message = "" , $statusCode = 200, $data = []){
        return response()->json([
            "statusCode" => $statusCode,
            "message" => $message ,
            "error" => false,
            "data" => $data,
        ],$statusCode, ['Content-Type' => 'application/json; charset=utf-8']);
    }

    public static function error ($message = "" , $statusCode = 500, $errorDetails = []){
        return response()->json([
            "statusCode" => $statusCode,
            "message" => $message ,
            "error" => true,
            "errorDetails" => $errorDetails,
        ],$statusCode, ['Content-Type' => 'application/json; charset=utf-8']);
    }
}
