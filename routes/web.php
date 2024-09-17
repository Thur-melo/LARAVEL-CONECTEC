<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);

Route::get('/home', [PostController::class, 'showHomeForm'])->name('home');
Route::post('/home', [PostController::class, 'postar']);


Route::get('/', [PostController::class, 'showHomeForm'])->name('home');

