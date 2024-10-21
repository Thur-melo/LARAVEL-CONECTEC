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

    
    public function seguindo(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'seguidores', 'seguidor_id', 'seguindo_id');
    }

    public function seguidores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'seguidores', 'seguindo_id', 'seguidor_id');
    }

}
