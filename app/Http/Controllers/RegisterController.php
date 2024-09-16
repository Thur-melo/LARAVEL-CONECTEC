<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

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



    public function register(Request $request)

    {
        

        $profilePhotoUrl = null;

        if ($request->hasFile('urlDaFoto')) {
            $file = $request->file('urlDaFoto');
            $profilePhotoUrl = $file->store('urlDaFoto', 'public');
        }

        Usuario::create([
            'nome' => $request->input('nome'),
            'emailUser' => $request->input('email'),
            'senha' => $request->input('senha'),
            'urlDaFoto' => $profilePhotoUrl,
            'modulo' => $request->input('module'),
            'perfil' => $request->input('role'),
           
        ]);

        $request->session()->flash('showModal', true);



        

         
     

        return redirect()->route('register')->with('status', 'Usuário registrado com sucesso');
    }



    
    public function login(Request $request){

        // dd([
        //     'emailUser' => $request->emailUser,
        //     'senha' => $request->senha,
           
        // ]);

        $usuario = Usuario::where('emailUser',$request->emailUser)->first();

        if ($usuario && $usuario->senha === $request ->senha){
            return redirect()->route('register')->with('status', 'Usuário Logado');
            return response()->json($usuario);

            
        }
       
        return response()->json(['message' => 'Seha errada ae pae, ou email errado'], 401);

       
    }
}






