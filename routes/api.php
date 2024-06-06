<?php

use App\Http\Controllers\Api\bukucontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/buku', [bukucontroller::class, 'index']);
Route::post('/buku', [bukucontroller::class, 'store']);
Route::get('/buku/{buku}', [bukucontroller::class, 'show']);
Route::put('/buku/{buku}', [bukucontroller::class, 'update']);
Route::delete('/buku/{buku}', [bukucontroller::class, 'destroy']);
