<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Shared\Infrastructure\Http\Controllers\Api\AuthController;
use App\Shared\Infrastructure\Http\Controllers\Api\ProductController;
use App\Shared\Infrastructure\Http\Controllers\Api\UserController;


// Public Routes
Route::post('/login', [AuthController::class, 'login']); 

// Authenticated User Routes
Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/user', function (Request $request): mixed {
        return $request->user(); 
    });

    Route::put('/user/update', [UserController::class, 'update']); 
    Route::put('/user/change-password', [UserController::class, 'changePassword']); 
    Route::delete('/user/account', [UserController::class, 'deleteAccount']); 

    Route::apiResource('products', ProductController::class); 

    Route::get('/profile', [AuthController::class, 'profile']); 

    // User Management Routes
    Route::post('/user/change-password', [UserController::class, 'changePassword']); 
    Route::delete('/user/delete-account', [UserController::class, 'deleteAccount']); 
});

// Fallback route for handling 404 errors
Route::fallback(function (): mixed {
    return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND); 
});

