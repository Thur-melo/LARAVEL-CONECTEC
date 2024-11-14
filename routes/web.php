<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\preferenciasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\BuscarUsuariosController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\SalvosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\seguirController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\notificacaoController;

// busca
Route::get('/denuncia/buscar', [DenunciaController::class, 'buscar'])->name('denuncia.buscar');


// Rota para desativar o usuário
Route::post('/admin/desativar-usuario/{id}', [AdminController::class, 'desativaUser'])->name('admin.desativarUsuario');
// Rota para ativar o usuário
Route::post('/admin/ativar-usuario/{id}', [AdminController::class, 'AtivaUser'])->name('admin.ativarUsuario');
Route::post('/denuncia/desativar/{userId}', [DenunciaController::class, 'desativarUsuario'])->name('user.desativar');
Route::post('/denuncia/ativar/{userId}', [DenunciaController::class, 'ativarUsuario'])->name('user.ativar');
Route::delete('/denuncia/{id}', [DenunciaController::class, 'deletarDenuncia'])->name('denuncia.deletar');


Route::post('/denuncia/desativar/{userId}', [DenunciaController::class, 'desativarUsuario'])->name('user.desativar');
Route::post('/denuncia/ativar/{userId}', [DenunciaController::class, 'ativarUsuario'])->name('user.ativar');

Route::delete('/denuncia/{id}', [DenunciaController::class, 'deletarDenuncia'])->name('denuncia.deletar');
Route::post('/denunciarUser', [DenunciaController::class, 'storeUser'])->name('denunciarUser');

Route::post('/denunciar', [DenunciaController::class, 'store'])->name('denunciar');
Route::get('/denuncias', [adminController::class, 'showdenuncias']) ->name('denuncias');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');


Route::get('/postagens', [RegisterController::class, 'showPostagens']) ->name('postagens');
Route::post('/post/update/{postID}', [PostController::class, 'update'])->name('post.update');



Route::delete('/adminPreferencias/{id}', [preferenciasController::class, 'destroy'])->name('preferenciasLista.destroy');
Route::post('/adminPreferencias', [preferenciasController::class, 'storeLista'])->name('preferenciasLista.store');
Route::get('/adminPreferencias', [preferenciasController::class, 'index'])->name('preferenciasLista');

Route::post('/preferencias', [preferenciasController::class, 'store'])->name('preferencias.store');
Route::get('/preferencias', [preferenciasController::class, 'showPreferencias'])->name('preferencias');

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/perfil/{id}', [adminController::class, 'showperfil'])->name('perfil');


Route::post('/profile/user/{id}', [adminController::class, 'update'])->name('user.update');
Route::get('/profile/{id}', [profileController::class,'profile'])->name('profile');




Route::get('/admin', [adminController::class, 'showadmin']) ->name('admin');

Route::get('adminHome', [adminController::class, 'ShowPerguntas']) ->name('adminHome');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{id}/aprovar', [PostController::class, 'updateStatus'])->name('posts.desativar');  
Route::patch('/posts/{id}/desativar', [PostController::class, 'updateAtiva'])->name('posts.aprovar'); 

Route::get('/home', [RegisterController::class, 'showHome'])->name('home');

Route::post('/home', [PostController::class, 'postar']); 

Route::get('/users', [BuscarUsuariosController::class, 'buscarUsuarios'])->name('buscar.usuarios');


Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');





Route::get('/registerAdm', [adminController::class, 'showAdmForm'])->name('registerAdm');
Route::post('/registerAdm', [adminController::class, 'registerAdm']);

Route::get('/loginAdm', [adminController::class, 'showLoginAdmForm'])->name('loginAdm');
Route::post('/loginAdm', [adminController::class, 'loginAdm']);

Route::get('/admin/buscar', [BuscarUsuariosController::class, 'buscarUsuariosAdmin'])->name('buscarUsuariosAdmin');
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
Route::post('/posts/{id}/salvo', [SalvosController::class, 'toggleSalvo'])->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
 


Route::post('/follow/{userId}', [seguirController::class, 'follow'])->name('follow');
Route::post('/unfollow/{userId}', [seguirController::class, 'unfollow'])->name('unfollow');


Route::get('/explorar', [PostController::class, 'showExplorar'])->name('explorar');


Route::middleware(['auth'])->group(function () {
    Route::get('/notificacoes', [notificacaoController::class, 'index'])->name('notificacoes.index');
    Route::post('/notificacoes/{id}/marcar-como-lida', [notificacaoController::class, 'marcarComoLida'])->name('notificacoes.marcarComoLida');
    Route::delete('/notificacoes/{id}/delete', [notificacaoController::class, 'destroy'])->name('notificacoes.destroy');
    Route::post('/notificacoes/marcar-todas-como-lidas', [notificacaoController::class, 'marcarTodasComoLidas'])->name('notificacoes.marcarTodasComoLidas');

});


