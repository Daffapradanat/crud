<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::post('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('me', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');
Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
