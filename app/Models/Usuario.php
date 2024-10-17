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
        'arroba',
        'emailUser',
        'senha',
        'modulo',
        'perfil',
        'urlDaFoto',
        'bio',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
