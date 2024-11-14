<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Seguir;
use Illuminate\Support\Facades\Auth;


class profileController extends Controller
{
    public function profile($id)
    {
        // Buscar usuário
        $usuario = User::findOrFail($id);
        $user = auth()->user();

        $post = Post::all();

        // Buscar posts do user auth
        $posts = Post::where('user_id', $usuario->id)->get();
        
        // Contar likes
        $likes = Likes::where('user_id', $usuario->id)->count();

        // Obtém as curtidas dos posts do usuário
        $curtidas = $usuario->likes()->pluck('post_id');
        $postCurtidas    = Post::whereIn('id', $curtidas)->get();

        $salvos = $usuario->salvos()->pluck('post_id');
        $postSalvos   = Post::whereIn('id', $salvos)->get();


        // Contar seguidores e seguindo
        $myseguidores = Seguir::where('seguindo_id', $usuario->id)->count();
        $seguindo = Seguir::where('seguidor_id', $usuario->id)->count();

        return view('profile', compact('usuario', 'posts', 'user', 'likes', 'myseguidores','postCurtidas','postSalvos', 'seguindo'));
    }
}
