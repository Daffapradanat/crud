<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\bukucontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/dashboard');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/store', [AuthenticationController::class, 'store'])->name('store');
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::resource('buku', bukucontroller::class);
