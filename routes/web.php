<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ChatController;


Route::get('/perfil', [adminController::class, 'showperfil']) ->name('perfil');
Route::post('/perfil/user/{id}', [adminController::class, 'update'])->name('user.update');


Route::get('/admin', [adminController::class, 'showadmin']) ->name('admin');

Route::get('adminHome', [adminController::class, 'ShowPerguntas']) ->name('adminHome');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{id}/aprovar', [PostController::class, 'updateStatus'])->name('posts.aprovar');


Route::get('/home', [RegisterController::class, 'showHome']) ->name('home');
Route::post('/home', [PostController::class, 'postar']); 

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);

Route::get('/registerAdm', [adminController::class, 'showAdmForm'])->name('registerAdm');
Route::post('/registerAdm', [adminController::class, 'registerAdm']);

Route::get('/loginAdm', [adminController::class, 'showLoginAdmForm'])->name('loginAdm');
Route::post('/loginAdm', [adminController::class, 'loginAdm']);


Route::delete('/admin/{id}', [adminController::class, 'desativaUser'])->name('user.off');
Route::patch('/admin/{id}', [adminController::class, 'AtivaUser'])->name('user.ativa');

Route::get('/comentarios/{id}', [ComentariosController::class, 'showcomentarios'])->name('comentarios');
Route::post('/comentarios/{postId}/comentarios', [ComentariosController::class, 'comentar'])->name('comentarios.store');




Route::post('/conversations', [ChatController::class, 'createConversation']);
Route::get('/conversations/{id}', [ChatController::class, 'showConversation'])->name('chat.show');
Route::post('/conversations/{conversationId}/messages', [ChatController::class, 'storeMessage']);
Route::get('/conversations', [ChatController::class, 'index'])->name('chat.list'); // Para listar conversas

