<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Likes;
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
    $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();
   
   

    $preferenciasLista = PreferenciasLista::all();
    if ($request->has('s')) {
        $posts = Post::search($request->input('s'));
    } else {
        $posts = Post::with('user')->where('status', 1)->orderBy('created_at', 'desc')->get();
    }
    $user = Auth::user();
    return view('home', compact('user', 'posts', 'preferenciasLista', 'usuariosSugestoes'));
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