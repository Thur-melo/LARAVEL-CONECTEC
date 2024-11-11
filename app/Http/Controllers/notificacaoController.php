<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\notificacoes;

class notificacaoController extends Controller
{
    public function index()

    {
        $user = auth()->user();
        $notificacoes = Auth::user()->notificacoes()->orderBy('created_at', 'desc')->get();
        $naoLidasCount = $notificacoes->where('lido', false)->count();
        return view('notificacoes', compact('notificacoes', 'naoLidasCount', 'user'));
    }

    public function marcarComoLida($id)
    {
        $notificacao = notificacoes::find($id);
        if ($notificacao && $notificacao->usuario_id == Auth::id()) {
            $notificacao->lido = true;
            $notificacao->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
{
    try {
        
        $notificacao = notificacoes::findOrFail($id);
        $notificacao->delete();

        
        return response()->json(['success' => true, 'message' => 'Notificação excluída com sucesso']);
    } catch (Exception $e) {
       
        return response()->json(['success' => false, 'message' => 'Erro ao excluir a notificação'], 500);
    }
}
}
