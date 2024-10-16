<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preferenciasLista extends Model
{
    use HasFactory;

    protected $table = 'preferenciasLista';

    protected $fillable = [
        'name',
    ];
    




public function users()
{
    return $this->belongsToMany(User::class, 'preferencia_user');
}

}