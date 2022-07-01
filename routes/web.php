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

//CategoryController
Route::get('category.index', [App\Http\Controllers\Category\CategoryController::class, 'index'])->name('category.index');
Route::get('category.create', [App\Http\Controllers\Category\CategoryController::class, 'create'])->name('category.create');
Route::post('category.store', [App\Http\Controllers\Category\CategoryController::class, 'store'])->name('category.store');
Route::get('category.edit/{id}', [App\Http\Controllers\Category\CategoryController::class, 'edit'])->name('category.edit');
Route::post('category.update/{id}', [App\Http\Controllers\Category\CategoryController::class, 'update'])->name('category.update');
Route::delete('category.delete/{id}', [App\Http\Controllers\Category\CategoryController::class, 'delete'])->name('category.delete');

//To show Subscriber List
Route::get('subscriber.index', function () {
    return view('subscriber.index');
})->name('subscriber.index');

//BookController
Route::get('book.index', [App\Http\Controllers\Book\BookController::class, 'index'])->name('book.index');
Route::get('book.create', [App\Http\Controllers\Book\BookController::class, 'create'])->name('book.create');
Route::post('book.store', [App\Http\Controllers\Book\BookController::class, 'store'])->name('book.store');
Route::delete('book.delete/{id}', [App\Http\Controllers\Book\BookController::class, 'delete'])->name('book.delete');
Route::get('book.download/{id}', [App\Http\Controllers\Book\BookController::class, 'download'])->name('book.download');
Route::get('book.edit/{id}', [App\Http\Controllers\Book\BookController::class, 'edit'])->name('book.edit');
Route::post('book.update/{id}', [App\Http\Controllers\Book\BookController::class, 'update'])->name('book.update');
