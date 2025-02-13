<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ctrl_usuarios;
use App\Http\Middleware\IntersepcionRuta;

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

//Route::apiResource('/users', Ctrl_usuarios::class); //->except(['index', 'show'])

Route::middleware([IntersepcionRuta::class])->group(function (){
    Route::apiResource('/users', Ctrl_usuarios::class);
    Route::get('/pruebaMid', [Ctrl_usuarios::class, 'pruebaMid']);
});

// =============================================================================
// PATCH -->  http://127.0.0.1:8000/api/users/1
// {
//     "status":"D"
// }