<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;


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

public function showHome()
{
    $user = Auth::user();
    $posts = Post::all();
    $posts = Post::with('user')->get();

    return view('home', compact('user', 'posts'));
}



    public function register(Request $request)

    {
        

        $profilePhotoUrl = null;

        if ($request->hasFile('urlDaFoto')) {
            $file = $request->file('urlDaFoto');
            $profilePhotoUrl = $file->store('urlDaFoto', 'public');
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'urlDaFoto' => $profilePhotoUrl,
            'modulo' => $request->input('module'),
            'perfil' => $request->input('role'),
           
        ]);

        $request->session()->flash('showModal', true);



        

         
     

        return redirect()->route('login')->with('status', 'Usuário registrado com sucesso');
    }



    
 






   public function login(Request $request){

    

     $credentials = $request->only('email','password');
     $autenticado =Auth::attempt($credentials);
        if(!$autenticado){
            return redirect()->route('login')->withErrors(['error' =>'Email ou senha errada']);

        }
        return redirect()->route('home', )->with(['success' =>'Logou']);
       
    }

    
}