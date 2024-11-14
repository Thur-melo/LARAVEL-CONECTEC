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

        Denuncia::create([
            'user_id' => $validatedData['user_id'],
            'post_id' => $validatedData['post_id'],
            'motivo' => $validatedData['motivo'],
            'status' => '',
        ]);

        return response()->json(['message' => 'Denúncia registrada com sucesso']);
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
                'status' => 'Ativo',
            ]);
    
            return response()->json(['message' => 'Denúncia registrada com sucesso']);
        } catch (\Exception $e) {
            \Log::error("Erro ao registrar denúncia: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao registrar denúncia'], 500);
        }
    }
    
}
