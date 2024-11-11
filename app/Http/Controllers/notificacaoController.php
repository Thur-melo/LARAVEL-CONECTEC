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
        $notificacoes = Auth::user()->notificacoes()->orderBy('created_at', 'desc')->get();
        $naoLidasCount = $notificacoes->where('lido', false)->count();
        return view('notificacoes', compact('notificacoes', 'naoLidasCount'));
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
}
