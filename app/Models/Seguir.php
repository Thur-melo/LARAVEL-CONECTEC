<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguir extends Model
{
    use HasFactory;

    protected $table = 'seguidores';

    protected $fillable = [
        'seguidor_id',
        'seguindo_id',
    ];

    /**
     * Define a relação com o modelo User (seguidor).
     */
    public function seguidor()
    {
        return $this->belongsTo(User::class, 'seguidor_id');
    }

    /**
     * Define a relação com o modelo User (seguindo).
     */
    public function seguindo()
    {
        return $this->belongsTo(User::class, 'seguindo_id');
    }
}
