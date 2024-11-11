<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\DenunciaUsuario;

class DenunciaController extends Controller
{
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
            'status' => 'pendente',
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
                'status' => 'pendente',
            ]);
    
            return response()->json(['message' => 'Denúncia registrada com sucesso']);
        } catch (\Exception $e) {
            \Log::error("Erro ao registrar denúncia: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao registrar denúncia'], 500);
        }
    }
    
}
