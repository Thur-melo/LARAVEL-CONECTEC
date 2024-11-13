<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\salvos;
use Illuminate\Support\Facades\Auth;

class SalvosController extends Controller
{
    public function toggleSalvo(Request $request, $postId)
    {
        $user = Auth::user();
        $post = Post::findOrFail($postId);
    
        // Verifica se o usuário já deu like
        $salvo= salvos::where('user_id', $user->id)->where('post_id', $postId)->first();
    
        if ($salvo) {
            // Se já deu salv$salvo, remove o salv$salvo
            $salvo->delete();
            $salvoStatus = 'unsalved';
        } else {
            // Se não deu like, cria um novo like
            salvos::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
            $salvoStatus = 'salved';
        }

        return response()->json([
            'salvosCount' => $post->likes()->count(),
           
            'status' => $salvoStatus,
            'message' => 'Like registrado e notificação enviada'
        ]);
    }
}
