<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('users')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Auth\JwtAuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\Auth\JwtAuthController::class, 'register']);
    Route::post('/refresh-token', [\App\Http\Controllers\Auth\JwtAuthController::class, 'refreshToken']);
    Route::post('/logout', [\App\Http\Controllers\Auth\JwtAuthController::class, 'logout']);
});
Route::apiResource('posts', PostController::class);



    // Additional API routes can be added here
