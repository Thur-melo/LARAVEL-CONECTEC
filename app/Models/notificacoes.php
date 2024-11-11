<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\notificacoes;


class notificacoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'tipo',
        'interacao_user_id',
        'post_id',
        'lido'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function interacaoUsuario()
{
    return $this->belongsTo(User::class, 'interacao_user_id'); // Usuário que fez a interação (like/comentário)
}

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
