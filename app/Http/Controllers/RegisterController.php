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


        

         
     

        return redirect()->route('register')->with('status', 'Usuário registrado com sucesso');
    }
}
