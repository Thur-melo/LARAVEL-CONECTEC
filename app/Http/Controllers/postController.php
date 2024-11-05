<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


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

    return redirect()->back()->with('success', 'Post deletado com sucessoaee!');
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

    public function update(Request $request, $id)
{
    

    $post = Post::findOrFail($id);
    $post->texto = $request->input('texto');

    if ($request->hasFile('fotoPost')) {
        // Excluir a imagem antiga, se existir
        if ($post->fotoPost) {
            Storage::delete('public/' . $post->fotoPost);
        }
        // Armazenar a nova imagem
        $path = $request->file('fotoPost')->store('posts', 'public');
        $post->fotoPost = $path;
    }

    $post->save();

    return redirect()->back()->with('success', 'Post atualizado com sucesso!');
}








    




}
