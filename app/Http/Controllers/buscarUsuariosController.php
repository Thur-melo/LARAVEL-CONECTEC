<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Certifique-se de incluir o modelo User

class BuscarUsuariosController extends Controller // Renomeando a classe
{
    public function buscarUsuarios(Request $request)
    {
        $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();

        $user = Auth::user();
       // Verifica se há uma pesquisa de postagens
       $searchTerm = $request->input('s'); 
        
        

            
            // Buscar usuários
            $users = User::where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('email', 'like', '%' . $searchTerm . '%')
            ->get(); 

        // Retornar a view com os usuários encontrados e o termo de busca
        return view('users', compact('users', 'user', 'searchTerm', 'usuariosSugestoes'));
    }



}
