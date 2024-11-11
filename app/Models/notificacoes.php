<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\notificacoes;


class notificacoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'tipo',
        'post_id',
        'lido'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
