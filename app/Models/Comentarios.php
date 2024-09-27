<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    // Defina a tabela associada ao modelo
    protected $table = 'comentarios';

    // Defina os atributos que podem ser preenchidos
    protected $fillable = [
        'texto',
        'user_id',
	    'post_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }








}
