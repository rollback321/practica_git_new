<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ctrl_usuarios;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

///Route::post('/index', [Ctrl_usuarios::class, 'index']);
    /**-->
     * {
            "status":"V",
            "search":"",
            "start_date":"",
            "end_date":"",
            "sort_by":{
                "status":false,
                "column":"us_nombres",
                "order_by":"asc"
            }
        }
     **/

///Route::get('/show/{id}', [Ctrl_usuarios::class, 'show']);

///Route::post('/store', [Ctrl_usuarios::class, 'store']);
// {
//     "us_password" : "dsadsaddsffddd",
//     "us_nom_usuario": "Ronaldsad123",
//     "us_nombres": "Ronald",
//     "us_paterno": "paterno",
//     "us_materno":"materno",
//     "us_estado":"V"
//   }

Route::apiResource('/users', Ctrl_usuarios::class); //->except(['index', 'show'])

//Route::patch('/users/{id}', [Ctrl_usuarios::class, 'update']);