<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;


    protected $table = 'cadastros_user';


    protected $fillable = [
        'nome',
        'emailUser',
        'senha',
        'modulo',
        'perfil',
        'urlDaFoto',
    ];
}
