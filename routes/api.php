<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('books', BookController::class);

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('me', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');
Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
