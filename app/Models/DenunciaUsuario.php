<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenunciaUsuario extends Model
{
    use HasFactory;

    protected $table = 'denunciausuario';

    protected $fillable = [
        'user_id',
        'user_denunciado_id',
        'motivo',
        'status',
    ];

    // Relacionamento com o usuário que fez a denúncia
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userDenunciado()
    {
        return $this->belongsTo(User::class, 'user_denunciado_id');
    }

}
