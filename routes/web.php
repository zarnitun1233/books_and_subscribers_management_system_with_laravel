<?php

use Illuminate\Support\Facades\Route;

// login logout
Route::get('login', [App\Http\Controllers\auth\AuthController::class, 'index'])->name('login');
Route::post('post-login', [App\Http\Controllers\auth\AuthController::class, 'postLogin'])->name('login.post');
Route::get('dashboard', [App\Http\Controllers\auth\AuthController::class, 'dashboard']);
Route::post('logout', [App\Http\Controllers\auth\AuthController::class, 'logout'])->name('logout');
