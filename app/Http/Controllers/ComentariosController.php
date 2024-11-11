<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comentarios;
use App\Models\notificacoes;

class ComentariosController extends Controller
{
 
  
    public function showcomentarios(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
    
        // Get the sorting option from the request (default to 'desc' if not specified)
        $sortOrder = $request->get('sortOrder', 'desc'); // 'desc' = "Mais recente", 'asc' = "Mais antigo"
        
        // Sort comments based on the sorting order
        $comentarios = Comentarios::where('post_id', $id)
            ->with('user')
            ->orderBy('created_at', $sortOrder)
            ->get();
    
        return view('comentarios', compact('post', 'comentarios', 'user', 'sortOrder'));
    }

    public function comentar(Request $request, $postId,)
    {
        // dd($request->all());
        $post = Post::findOrFail($postId);
        // Criação do comentário
        Comentarios::create([
            'texto' => $request->input('texto'),
            'user_id' => Auth::id(), // ID do usuário que está comentando
            'post_id' => $postId, // Referência ao post
        ]);

        notificacoes::create([
            'usuario_id' => $post->user_id,
            'interacao_user_id' => Auth::id(),
            'tipo' => 'comentario',
            'post_id' => $postId
        ]);
    
        // return redirect()->route('comentarios')->with('status', 'Comentário registrado com sucesso');

        return redirect()->route('comentarios', ['id' => $postId])->with('status', 'Comentário registrado com sucesso');

      
    }
   
      
    

}
