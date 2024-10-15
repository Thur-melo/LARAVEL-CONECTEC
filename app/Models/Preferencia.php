<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferencia extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'preferencia_id','nomePreferencia']; // Atualize para 'preferencia_id'
}