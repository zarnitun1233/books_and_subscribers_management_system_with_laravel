<?php

use Illuminate\Support\Facades\Route;

// login, logout, dashboard
Route::get('login', [App\Http\Controllers\auth\AuthController::class, 'index'])->name('login');
Route::post('post-login', [App\Http\Controllers\auth\AuthController::class, 'postLogin'])->name('login.post');
Route::get('dashboard', [App\Http\Controllers\auth\AuthController::class, 'dashboard']);
Route::post('logout', [App\Http\Controllers\auth\AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [App\Http\Controllers\auth\AuthController::class, 'dashboard'])->name('dashboard');

//AuthorController
Route::get('author-index', [App\Http\Controllers\Author\AuthorController::class, 'index'])->name('author.index');
Route::get('author-create', [App\Http\Controllers\Author\AuthorController::class, 'create'])->name('author.create');
Route::post('author-store', [App\Http\Controllers\Author\AuthorController::class, 'store'])->name('author.store');
Route::get('author-edit/{id}', [App\Http\Controllers\Author\AuthorController::class, 'edit'])->name('author.edit');
Route::post('author-update/{id}', [App\Http\Controllers\Author\AuthorController::class, 'update'])->name('author.update');
Route::delete('author-delete/{id}', [App\Http\Controllers\Author\AuthorController::class, 'delete'])->name('author.delete');