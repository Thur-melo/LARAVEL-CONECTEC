<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\adminController;


Route::get('/admin', [adminController::class, 'showadmin']) ->name('admin');
Route::post('/admin/user/{id}', [adminController::class, 'update'])->name('user.update');



Route::get('/home', [RegisterController::class, 'showHome']) ->name('home');
Route::post('/home', [PostController::class, 'postar']); 

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);





