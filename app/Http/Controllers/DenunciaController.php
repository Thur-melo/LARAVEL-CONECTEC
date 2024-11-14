<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\DenunciaUsuario;
use App\Models\User;

class DenunciaController extends Controller
{


     // Método para desativar um usuário
     public function desativarUsuario($userId)
     {
         $user = User::findOrFail($userId);
         $user->status = 'inativo';
         $user->save();
 
         return response()->json(['message' => 'Usuário desativado com sucesso!']);
     }
 
     // Método para ativar um usuário
     public function ativarUsuario($userId)
     {
         $user = User::findOrFail($userId);
         $user->status = 'ativo';
         $user->save();
 
         return response()->json(['message' => 'Usuário ativado com sucesso!']);
     }
    public function deletarDenuncia($id)
{
    // Encontra a denúncia pelo ID
    $denunciaUser = DenunciaUsuario::findOrFail($id);
    
    // Exclui a denúncia do banco de dados
    $denunciaUser->delete();
    
    // Retorna uma resposta JSON para confirmar a exclusão
    return response()->json(['message' => 'Denúncia excluída com sucesso.']);
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'post_id' => 'required|exists:posts,id',
        'motivo' => 'required|string|max:255',
    ]);

    try {
        Denuncia::create([
            'user_id' => $validatedData['user_id'],
            'post_id' => $validatedData['post_id'],
            'motivo' => $validatedData['motivo'],
            'status' => 'pendente',  // Defina o valor padrão de status
        ]);

        return response()->json(['message' => 'Denúncia registrada com sucesso']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao registrar a denúncia.'], 500);
    }
}

    public function storeUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'user_denunciado_id' => 'required|exists:users,id',
                'motivo' => 'required|string|max:255',
            ]);
    
            DenunciaUsuario::create([
                'user_id' => $validatedData['user_id'],
                'user_denunciado_id' => $validatedData['user_denunciado_id'],
                'motivo' => $validatedData['motivo'],
                'status' => 'Pendente',
            ]);
    
            return response()->json(['message' => 'Denúncia registrada com sucesso']);
        } catch (\Exception $e) {
            \Log::error("Erro ao registrar denúncia: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao registrar denúncia'], 500);
        }
    }

    public function buscar(Request $request)
    {
        $termo = $request->query('termo', '');

        // Buscando denúncias de usuários
        $denunciasUser = Denuncia::whereHas('userDenunciado', function ($query) use ($termo) {
            $query->where('name', 'like', '%' . $termo . '%');
        })->get();

        // Buscando denúncias de posts
        $denunciasPosts = Denuncia::whereHas('post', function ($query) use ($termo) {
            $query->where('titulo', 'like', '%' . $termo . '%');
        })->get();

        return response()->json([
            'denunciasUser' => $denunciasUser,
            'denunciasPosts' => $denunciasPosts
        ]);
    }
    
}
