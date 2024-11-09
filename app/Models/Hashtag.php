<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;
    // Define o relacionamento muitos-para-muitos com Post
    protected $table = 'hashtags';

    protected $fillable = [
        'hashtag',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_hashtags');
    }
}


