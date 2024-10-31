<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    // Puedes devolver una respuesta vacía o algo como "No necesita inicio de sesión"
    return response()->json(['message' => 'Login endpoint not defined'], 404);
});
