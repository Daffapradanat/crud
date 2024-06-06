<?php

use App\Http\Controllers\Api\bukucontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiresource('buku', bukucontroller::class);

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('me', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');
Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
