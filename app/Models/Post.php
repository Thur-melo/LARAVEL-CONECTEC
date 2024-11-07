<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';  // Nome da tabela no banco de dados

    protected $fillable = [
        'texto',
        'user_id',
        'fotoPost',
        'status',
        'tipo_post',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com os likes (tabela likes)
    public function likes()
    {
        return $this->hasMany(Likes::class, 'post_id', 'id');
    }

    // Relacionamento com os comentários (tabela comentarios)
    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'post_id', 'id');  // Verifique a chave estrangeira correta
    }

    public static function search($searchTerm)
    {
        return self::where('texto', 'like', "%{$searchTerm}%")->get();
    }
}


