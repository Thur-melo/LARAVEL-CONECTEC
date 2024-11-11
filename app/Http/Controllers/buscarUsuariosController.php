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
        // Obter o termo de busca da requisição
        $search = $request->input('search');

        // Buscar usuários com o termo fornecido
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('arroba', 'like', '%' . $search . '%')
            ->get();

        // Retornar a view com os usuários encontrados e o termo de busca
        return view('users', compact('users', 'user', 'search', 'usuariosSugestoes'));
    }



}
