<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ctrl_usuarios;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/init', [Ctrl_usuarios::class, 'index']);

Route::get('/find', [Ctrl_usuarios::class, 'show']);