<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Hashtag;
use App\Models\Seguir;


use App\Models\preferenciasLista;

class RegisterController extends Controller
{
    //
    public function showForm()
    {
        return view('register');
    }

    public function showLoginForm()
{
    return view('login');
}

public function showPostagens()
{   

    $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();
    $user = Auth::user();
    $posts = Post::where('user_id', $user->id)->get();
    $postsCount = $posts->count(); 
    
    return view('postagens',compact('user', 'usuariosSugestoes', 'posts','postsCount'));
}
public function showHome(Request $request)
{
    $user = Auth::user();
    $seguindo = $user->seguindo; 
    $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();
    $preferenciasLista = PreferenciasLista::all();

    // Verifica se há uma pesquisa de postagens
    if ($request->has('s')) {
        $posts = Post::search($request->input('s'));  // Supondo que você tenha implementado um escopo de busca
    } else {

        
       
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
$feedPosts = $followedPosts->merge($hashtagPosts)->merge($popularPosts)->unique('id');

// 5. Ordenar o feed pela data de criação
$posts = $feedPosts;
    }

    return view('home', compact('user', 'posts', 'preferenciasLista', 'usuariosSugestoes'));
}

public function getHashtagsByCurso(User $user)
{
    // Defina as hashtags para cada curso
    $hashtagsPorCurso = [
        'Ds' => ['programacao', 'laravel', 'PHP'],
        'Nutri' => ['nutricao', 'saude', 'alimentacao'],
        'Adm' => ['gestao', 'administracao', 'marketing'],
    ];

    // Verifique o perfil do usuário e retorne as hashtags associadas
   
    if (array_key_exists($user->perfil, $hashtagsPorCurso)) {

        return Hashtag::whereIn('hashtag', $hashtagsPorCurso[$user->perfil])->get();
    }

    return collect(); // Se o perfil não for encontrado, retorne uma coleção vazia
}



    public function register(Request $request)

    {
        if (!str_contains($request->input('email'), 'etec')) {
            return redirect()->back()->withErrors([
                'email' => 'O email precisa conter "etec".',
            ]);
        }

        $profilePhotoUrl = 'img/default.jpg';

        if ($request->hasFile('urlDaFoto')) {
            $file = $request->file('urlDaFoto');
            $profilePhotoUrl = $file->store('urlDaFoto', 'public');
        } 
            

        User::create([
            'name' => $request->input('name'),
            'arroba' => $request->input('arroba'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'urlDaFoto' => $profilePhotoUrl,
            'modulo' => $request->input('module'),
            'perfil' => $request->input('role'),
            'bio' => $request->input('bio'), // Adiciona o campo bio

           
        ]);

        return redirect()->route('login')->with([
            'status' => 'Usuário registrado com sucesso',
            'showModal' => true,
        ]);

    }




   public function login(Request $request){

    

     $credentials = $request->only('email','password');
     $autenticado =Auth::attempt($credentials);
        if(!$autenticado){
            return redirect()->route('login')->withErrors(['error' =>'Email ou senha errada']);

        }
        $user = Auth::user();

        // Verificando o status do usuário
        if ($user->status === 'Off') {
            Auth::logout(); // Deslogar o usuário
            return redirect()->route('login')->withErrors(['error' => 'Sua conta está desativada.']);
        }
        
        return redirect()->route('home', )->with(['success' =>'Logou']);
       
    }


    public function logout(Request $request)
    {
        Auth::guard()->logout();

        // Invalida a sessão atual e regenera o token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redireciona para a página de login
        return redirect('/login');
    }



    public function update(Request $request, $postID)
    {
        // Validação dos dados do formulário
        $request->validate([
            'texto' => 'required|string',
            'fotoPost' => 'nullable|image|max:2048',
        ]);
    
        // Encontrar o post pelo ID
        $post = Post::findOrFail($postID);

        if ($request->hasFile('urlDoBanner')) {
            $file = $request->file('urlDoBanner');
            $profilePhotoUrl = $file->store('urlDoBanner', 'public');
        } 
    
        // Atualizar o conteúdo do post
        $post->update([
            'texto' => $request->input('texto'),
            'fotoPost' => $request->file('fotoPost') ? $request->file('fotoPost')->store('posts') : $post->fotoPost,
        ]);
    
        // Redirecionar com sucesso
        return redirect()->route('postagens')->with('status', 'Post atualizado com sucesso!');
    }
    
    






}