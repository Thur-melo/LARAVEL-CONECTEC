<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Post;
use App\Models\notificacoes;
use Illuminate\Support\Facades\Auth;



class likeController extends Controller
{
    public function toggleLike(Request $request, $postId)
    {
        $user = Auth::user();
        $post = Post::findOrFail($postId);
    
        // Verifica se o usuário já deu like
        $like = Likes::where('user_id', $user->id)->where('post_id', $postId)->first();
    
        if ($like) {
            // Se já deu like, remove o like
            $like->delete();
            $likeStatus = 'unliked';
        } else {
            // Se não deu like, cria um novo like
            Likes::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
            $likeStatus = 'liked';
        }

        // Retorna a contagem atualizada de likes e o status
       

        notificacoes::create([
            'usuario_id' => $post->user_id,
            'tipo' => 'like',
            'interacao_user_id' => $user->id,
            'post_id' => $postId
        ]);

        return response()->json([
            'likesCount' => $post->likes()->count(), // Conta o número total de likes
            'status' => $likeStatus,
            'message' => 'Like registrado e notificação enviada'
        ]);
    }
}    
