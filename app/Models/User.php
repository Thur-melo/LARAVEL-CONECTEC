<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'arroba',
        'email',
        'password',
        'modulo',
        'perfil',
        'status',
        'urlDaFoto',
        'bio',
        'urlDoBanner'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function preferenciasLista()
    {
        return $this->belongsToMany(PreferenciasLista::class, 'preferencias', 'user_id', 'preferencia_id');
    }

    
    public function seguindo()
    {
        return $this->belongsToMany(User::class, 'seguidores', 'seguidor_id', 'seguindo_id');
    }
    

    public function seguidores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'seguidores', 'seguindo_id', 'seguidor_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function hashtags()
    {
        // Relacionamento com Hashtag através da tabela intermediária 'post_hashtag'
        return $this->belongsToMany(Hashtag::class, 'post_hashtag', 'post_id', 'hashtag_id')
                    ->withTimestamps();
    }

    /**
     * Método para retornar as hashtags associadas às postagens do usuário.
     */
    public function likedHashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'post_hashtags', 'post_id', 'hashtag_id')
                    ->distinct();
    }
    public function getCursoAttribute()
    {
        return $this->perfil;
    }

    public function likedPosts()
{
    // Relacionamento com a tabela de likes para obter os posts que o usuário curtiu
    return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
}


    public function notificacoes()
{
    return $this->hasMany(notificacoes::class, 'usuario_id');
}
}
