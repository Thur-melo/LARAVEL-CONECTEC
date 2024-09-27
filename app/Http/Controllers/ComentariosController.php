<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comentarios;

class ComentariosController extends Controller
{
 
    public function showcomentarios($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $comentarios = Comentarios::where('post_id', $id)->with('user')->get();
        return view('comentarios', compact('post', 'comentarios', 'user'));
    }

    public function comentar(Request $request, $postId)
    {
        // dd($request->all());
        // Criação do comentário
        Comentarios::create([
            'texto' => $request->input('texto'),
            'user_id' => Auth::id(), // ID do usuário que está comentando
            'post_id' => $postId, // Referência ao post
        ]);
    
        // return redirect()->route('comentarios')->with('status', 'Comentário registrado com sucesso');

        return redirect()->route('comentarios', ['id' => $postId])->with('status', 'Comentário registrado com sucesso');
    }
   
      
    

}
