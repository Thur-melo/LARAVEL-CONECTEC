<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Defina a tabela associada ao modelo
    protected $table = 'posts';

    // Defina os atributos que podem ser preenchidos
    protected $fillable = [
        'texto',
        'user_id',
        'fotoPost',
      
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
