<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class postController extends Controller
{

    
    public function postar(Request $request)
    
    {
        $profilePhotoPost = null;
    
        if ($request->hasFile('fotoPost')) {
            $file = $request->file('fotoPost');
            $profilePhotoPost = $file->store('fotoPost', 'public');
        }


        Post::create([
            'texto' => $request->input('texto'),
            'user_id' => Auth::id(),  
            'fotoPost' =>  $profilePhotoPost,
            'tipo_post' => $request->input('tipo'),

        
     ]);

     return redirect()->route('home')->with('status', 'Post registrado com sucesso');
 }
 
public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('adminHome')->with('success', 'Post deletado com sucesso!');
}

public function updateStatus($id)
{
    $post = Post::findOrFail($id); // Encontre o post pelo ID
    $post->status = 2; // Muda o status para 2
    $post->save(); // Salva as alterações

    return redirect()->route('adminHome')->with('success', 'Status do post atualizado para 2!');
}


public function updateAtiva($id)
{
    $post = Post::findOrFail($id); // Encontre o post pelo ID
    $post->status = 1; // Muda o status para 2
    $post->save(); // Salva as alterações

    return redirect()->route('adminHome')->with('success', 'Status do post atualizado para 2!');
}

public function popular()
    {
        $posts = Post::with('user') // Carregar o usuário que fez o post
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', ['posts' => $posts]);
    }

    public function seguindo()
    {
        $user = Auth::user();

        
        $seguindoIds = $user->seguindo()->pluck('id');

        // Pegar apenas os posts desses usuários
        $posts = Post::whereIn('user_id', $seguindoIds)
            ->with('user') // Carregar o usuário que fez o post
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', ['posts' => $posts]);
    }




}
