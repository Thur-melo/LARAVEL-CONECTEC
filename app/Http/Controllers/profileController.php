<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class profileController extends Controller
{
    public function profile($id)
    {
        $usuario= User::findOrFail($id);
        $user = auth()->user();

        $posts = Post::where('user_id', $usuario->id)->get();

        return view('profile', compact('usuario','posts', 'user'));

    }
}
