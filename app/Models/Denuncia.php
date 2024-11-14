<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncia';

    protected $fillable = [
        'user_id',
        'post_id',
        'motivo',
        'status',
    ];

    // Relacionamento com o usuário que fez a denúncia
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com o post denunciado
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function relevar()
    {
        return $this->delete();
    }
}
