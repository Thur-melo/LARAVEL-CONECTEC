<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\preferenciasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\seguirController;


Route::get('/postagens', [RegisterController::class, 'showPostagens']) ->name('postagens');


Route::delete('/adminPreferencias/{id}', [preferenciasController::class, 'destroy'])->name('preferenciasLista.destroy');
Route::post('/adminPreferencias', [preferenciasController::class, 'storeLista'])->name('preferenciasLista.store');
Route::get('/adminPreferencias', [preferenciasController::class, 'index'])->name('preferenciasLista');

Route::post('/preferencias', [preferenciasController::class, 'store'])->name('preferencias.store');
Route::get('/preferencias', [preferenciasController::class, 'showPreferencias'])->name('preferencias');

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/perfil', [adminController::class, 'showperfil']) ->name('perfil');
Route::post('/perfil/user/{id}', [adminController::class, 'update'])->name('user.update');
Route::get('/profile/{id}', [profileController::class,'profile'])->name('profile');




Route::get('/admin', [adminController::class, 'showadmin']) ->name('admin');

Route::get('adminHome', [adminController::class, 'ShowPerguntas']) ->name('adminHome');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{id}/aprovar', [PostController::class, 'updateStatus'])->name('posts.desativar');  
Route::patch('/posts/{id}/desativar', [PostController::class, 'updateAtiva'])->name('posts.aprovar'); 

Route::get('/home', [RegisterController::class, 'showHome']) ->name('home');
Route::post('/home', [PostController::class, 'postar']); 

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');





Route::get('/registerAdm', [adminController::class, 'showAdmForm'])->name('registerAdm');
Route::post('/registerAdm', [adminController::class, 'registerAdm']);

Route::get('/loginAdm', [adminController::class, 'showLoginAdmForm'])->name('loginAdm');
Route::post('/loginAdm', [adminController::class, 'loginAdm']);


Route::delete('/admin/{id}', [adminController::class, 'desativaUser'])->name('user.off');
Route::patch('/admin/{id}', [adminController::class, 'AtivaUser'])->name('user.ativa');

Route::get('/posts/{id}/comentarios', [ComentariosController::class, 'showcomentarios'])->name('comentarios.show');
Route::get('/comentarios/{id}', [ComentariosController::class, 'showcomentarios'])->name('comentarios');
Route::post('/comentarios/{postId}/comentarios', [ComentariosController::class, 'comentar'])->name('comentarios.store');




Route::post('/conversations', [ChatController::class, 'createConversation']);
Route::get('/conversations/{id}', [ChatController::class, 'showConversation'])->name('chat.show');
Route::post('/conversations/{conversationId}/messages', [ChatController::class, 'storeMessage']);
Route::get('/conversations', [ChatController::class, 'index'])->name('chat.list'); // Para listar conversas



Route::post('/posts/{id}/like', [LikeController::class, 'toggleLike'])->middleware('auth');
 

Route::post('/follow/{userId}', [seguirController::class, 'follow'])->name('follow');
Route::post('/unfollow/{userId}', [seguirController::class, 'unfollow'])->name('unfollow');