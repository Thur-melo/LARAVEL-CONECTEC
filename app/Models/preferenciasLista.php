<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenciasLista extends Model
{
    use HasFactory;

    protected $table = 'preferenciasLista';

    protected $fillable = [
        'name',
        'curso',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'preferencias', 'preferencia_id', 'user_id');
    }

    public static function search($searchTerm)
    {
        return self::where('name', 'like', "%{$searchTerm}%")->get();
    }
}
