<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

