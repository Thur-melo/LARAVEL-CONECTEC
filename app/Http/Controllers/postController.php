<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\PreferenciasLista;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class postController extends Controller
{

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id); // Aqui você carrega o post com o usuário associado
        return response()->json($post);
    }
                    
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
    // Remove o caractere '#' do início, se existir
    $hashtagText = ltrim($hashtagText, '#');
    
    // Remove acentos e transforma para minúsculas
    $hashtagText = Str::ascii($hashtagText); // Remove os acentos
    $hashtagText = strtolower($hashtagText); // Converte para minúsculas

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
    // Encontra todas as hashtags no texto, considerando letras, números, acentos e o "ç"
    preg_match_all('/#([\p{L}\p{N}_]+)/u', $content, $matches);
    
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

    $posts = Post::all();

    $user =  Auth::user();
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

      
    // 1. Postagens dos usuários seguidos
    $followedPosts = Post::whereIn('user_id', $user->seguindo()->pluck('seguindo_id'))
    ->with(['user', 'hashtags', 'likes'])
    ->orderByDesc('created_at')
    ->get();

 // 2. Postagens com hashtags relacionadas ao curso do usuário
 $hashtagsCurso = $this->getHashtagsByCurso($user);

 $hashtagPosts = collect();
   // Criando uma coleção vazia inicialmente

 if ($hashtagsCurso->isNotEmpty()) {
     // Busca postagens que tenham as hashtags associadas ao curso do usuário
     $hashtagPosts = Post::whereHas('hashtags', function ($query) use ($hashtagsCurso) {
         $query->whereIn('hashtags.hashtag', $hashtagsCurso->pluck('hashtag'));  // Ajuste aqui
     })
     ->with(['user', 'hashtags', 'likes'])
     ->orderByDesc('created_at')
     ->get();
 }


// 3. Postagens populares (baseadas em curtidas)
$popularPosts = Post::withCount('likes')
    ->orderByDesc('likes_count')
    ->take(10)
    ->get();

// 4. Juntar tudo e remover postagens duplicadas
$feedPosts = $hashtagPosts->merge($popularPosts)->merge($followedPosts)->unique('id');

// 5. Ordenar o feed pela data de criação
$postrecomendados = $feedPosts;

$preferenciasLista = PreferenciasLista::all();
    // Retorna a view com todas as variáveis necessárias
    return view('explorar', compact('user', 'posts', 'postsCurtidas', 'preferenciasLista', 'postrecomendados',  'postsComentarios'));
}


public function getHashtagsByCurso(User $user)
{
    // Defina as hashtags para cada curso
    $hashtagsPorCurso = [
        'Ds' => ['programacao', 'laravel', 'php'],
        'Nutri' => ['nutricao', 'saude', 'alimentacao'],
        'Adm' => ['gestao', 'administracao', 'marketing'],
    ];

    // Verifique o perfil do usuário e retorne as hashtags associadas
   
    if (array_key_exists($user->perfil, $hashtagsPorCurso)) {

        return Hashtag::whereIn('hashtag', $hashtagsPorCurso[$user->perfil])->get();
    }

    return collect(); // Se o perfil não for encontrado, retorne uma coleção vazia
}






    




}
