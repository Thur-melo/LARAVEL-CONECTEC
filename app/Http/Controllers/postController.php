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
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        
        // Alterna o status entre 1 (ativo) e 2 (desativado)
        $post->status = $post->status == 1 ? 2 : 1;
        $post->save();
    
        // Redireciona de volta para a página com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Status do post atualizado com sucesso!');
    }
    
    
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

        $posts = Post::where('status', 1)->get();

        $user =  Auth::user();
        // Posts com mais curtidas
        $postsCurtidas = Post::withCount('likes') // Conta os likes
            ->where('status', 1)
            ->orderBy('likes_count', 'desc') // Ordena por likes_count
            ->get();

        // Posts com mais comentários
        $postsComentarios = Post::withCount('comentarios') // Conta os comentários
            ->where('status', 1)
            ->orderBy('comentarios_count', 'desc') // Ordena por comentarios_count
            ->get();

        // Supondo que você tenha um modelo Post e um modelo User

        $postsAds = Post::whereHas('user', function ($query) {
            $query->where('perfil', 'Ds'); // Filtra usuários com perfil 'ads'
        })->inRandomOrder()->get();

        $postsNutri = Post::whereHas('user', function ($query) {
            $query->where('perfil', 'Nutri'); // Filtra usuários com perfil 'ads'
        })->inRandomOrder()->get();

        $postsAdm = Post::whereHas('user', function ($query) {
            $query->where('perfil', 'Adm'); // Filtra usuários com perfil 'ads'
        })->inRandomOrder()->get();


        $hashtags = Hashtag::withCount('posts') // Conta os posts relacionados
        ->orderBy('posts_count', 'desc') // Ordena pela contagem
        ->take(9)
        ->get(); // Obtém as hashtags





        return view('explorar', compact('user', 'posts', 'postsCurtidas', 'postsComentarios', 'postsAds', 'postsNutri', 'postsAdm', 'hashtags'));
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
