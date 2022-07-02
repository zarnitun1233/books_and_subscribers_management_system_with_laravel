<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailTest;
use App\Jobs\SendEmail;

// login, logout, dashboard
Route::get('login', [App\Http\Controllers\auth\AuthController::class, 'index'])->name('login');
Route::post('post-login', [App\Http\Controllers\auth\AuthController::class, 'postLogin'])->name('login.post');
Route::get('dashboard', [App\Http\Controllers\auth\AuthController::class, 'dashboard'])->middleware('auth');
Route::post('logout', [App\Http\Controllers\auth\AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('dashboard', [App\Http\Controllers\auth\AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/', [App\Http\Controllers\auth\AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

//AuthorController
Route::get('author-index', [App\Http\Controllers\Author\AuthorController::class, 'index'])->name('author.index')->middleware('auth');
Route::get('author-create', [App\Http\Controllers\Author\AuthorController::class, 'create'])->name('author.create')->middleware('auth');
Route::post('author-store', [App\Http\Controllers\Author\AuthorController::class, 'store'])->name('author.store')->middleware('auth');
Route::get('author-edit/{id}', [App\Http\Controllers\Author\AuthorController::class, 'edit'])->name('author.edit')->middleware('auth');
Route::post('author-update/{id}', [App\Http\Controllers\Author\AuthorController::class, 'update'])->name('author.update')->middleware('auth');
Route::delete('author-delete/{id}', [App\Http\Controllers\Author\AuthorController::class, 'delete'])->name('author.delete')->middleware('auth');

//CategoryController
Route::get('category.index', [App\Http\Controllers\Category\CategoryController::class, 'index'])->name('category.index')->middleware('auth');
Route::get('category.create', [App\Http\Controllers\Category\CategoryController::class, 'create'])->name('category.create')->middleware('auth');
Route::post('category.store', [App\Http\Controllers\Category\CategoryController::class, 'store'])->name('category.store')->middleware('auth');
Route::get('category.edit/{id}', [App\Http\Controllers\Category\CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
Route::post('category.update/{id}', [App\Http\Controllers\Category\CategoryController::class, 'update'])->name('category.update')->middleware('auth');
Route::delete('category.delete/{id}', [App\Http\Controllers\Category\CategoryController::class, 'delete'])->name('category.delete')->middleware('auth');

//To show Subscriber List
Route::get('subscriber.index', function () {
    return view('subscriber.index');
})->name('subscriber.index')->middleware('auth');

//BookController
Route::get('book.index', [App\Http\Controllers\Book\BookController::class, 'index'])->name('book.index')->middleware('auth');
Route::get('book.create', [App\Http\Controllers\Book\BookController::class, 'create'])->name('book.create')->middleware('auth');
Route::post('book.store', [App\Http\Controllers\Book\BookController::class, 'store'])->name('book.store')->middleware('auth');
Route::delete('book.delete/{id}', [App\Http\Controllers\Book\BookController::class, 'delete'])->name('book.delete')->middleware('auth');
Route::get('book.download/{id}', [App\Http\Controllers\Book\BookController::class, 'download'])->name('book.download')->middleware('auth');
Route::get('book.edit/{id}', [App\Http\Controllers\Book\BookController::class, 'edit'])->name('book.edit')->middleware('auth');
Route::post('book.update/{id}', [App\Http\Controllers\Book\BookController::class, 'update'])->name('book.update')->middleware('auth');

//EmailController
Route::get('email/{id}', [App\Http\Controllers\Email\EmailController::class, 'email'])->name('email')->middleware('auth');
Route::get('email.index', function () {
    return view('email.index');
})->name('email.index')->middleware('auth');
