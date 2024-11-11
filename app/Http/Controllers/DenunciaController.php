<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

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
}
