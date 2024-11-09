<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\PreferenciasLista;
use Illuminate\Support\Facades\Storage;



class postController extends Controller
{

    
    public function postar(Request $request)
    {
        // Inicializa a variável para a foto
        $profilePhotoPost = null;

        // Verifica se foi enviado um arquivo de foto
        if ($request->hasFile('fotoPost')) {
            $file = $request->file('fotoPost');
            $profilePhotoPost = $file->store('fotoPost', 'public');
        }

        try {
            // Cria o post
            $post = Post::create([
                'texto' => $request->input('texto'),
                'user_id' => Auth::id(),
                'fotoPost' => $profilePhotoPost,
                'tipo_post' => $request->input('tipo'),
            ]);

           // Extrai as hashtags do conteúdo do post
    $hashtags = $this->extractHashtags($request->input('texto'));



          // Associa as hashtags ao post
  $hashtags = $this->extractHashtags($request->input('texto'));

    // Associa as hashtags ao post
    foreach ($hashtags as $hashtagText) {
        $hashtagText = ltrim($hashtagText, '#');
        $hashtagText = strtolower($hashtagText);

        // Verifica ou cria a hashtag
        $hashtag = Hashtag::firstOrCreate(['hashtag' => $hashtagText]);

        // Associa a hashtag ao post
        $post->hashtags()->attach($hashtag);
    }

            
            // Redireciona com uma mensagem de sucesso
            return redirect()->route('home')->with('status', 'Post registrado com sucesso');
        } catch (\Exception $e) {
            // Redireciona com uma mensagem de erro
            return redirect()->route('home')->with('error', 'Erro ao registrar o post');
        }
    }

    // Método para extrair hashtags do conteúdo do post
    private function extractHashtags($content)
    {
        // Encontra todas as hashtags no texto usando regex (considerando #palavras com números e letras)
        preg_match_all('/#(\w+)/', $content, $matches);
        return $matches[0]; // Retorna as hashtags encontradas
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





public function showExplorar(Request $request)
{
    // Posts com mais curtidas
    $postsCurtidas = Post::withCount('likes') // Conta os likes
        ->where('status', 1)
        ->orderBy('likes_count', 'desc') // Ordena por likes_count
        ->take(4)
        ->get();

    // Posts com mais comentários
    $postsComentarios = Post::withCount('comentarios') // Conta os comentários
        ->where('status', 1)
        ->orderBy('comentarios_count', 'desc') // Ordena por comentarios_count
        ->take(4)
        ->get();

    // Posts aleatórios
    $postsAleatorios = Post::inRandomOrder()->where('status', 1)->take(4)->get();

    // Sugestões de usuários aleatórios
    $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();
    
    // Posts gerais (ordenados pela data de criação)
    $posts = Post::with('user')->where('status', 1)->orderBy('created_at', 'desc')->get();

    // Usuário autenticado
    $user = Auth::user();

    $preferenciasLista = PreferenciasLista::all();

    // Retorna a view com todas as variáveis necessárias
    return view('explorar', compact('user', 'posts', 'postsCurtidas', 'preferenciasLista', 'postsAleatorios', 'usuariosSugestoes', 'postsComentarios'));
}






    




}
