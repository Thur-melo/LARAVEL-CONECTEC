<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class seguirController extends Controller
{

    public function follow($userId)
    {
        $user = Auth::user(); // Usuário atual
        $userToFollow = User::findOrFail($userId); // Usuário a ser seguido
    
        // Verifica se o usuário atual já está seguindo o usuário a ser seguido
        if (!$user->seguindo()->where('seguindo_id', $userToFollow->id)->exists()) {
            $user->seguindo()->attach($userToFollow->id);
        }
    
        return response()->json(['status' => 'followed']);
    }
    
    public function unfollow($userId)
    {
        $user = Auth::user(); // Usuário atual
        $userToUnfollow = User::findOrFail($userId); // Usuário a deixar de seguir
    
        // Verifica se o usuário atual está seguindo o usuário a deixar de seguir
        if ($user->seguindo()->where('seguindo_id', $userToUnfollow->id)->exists()) {
            $user->seguindo()->detach($userToUnfollow->id);
        }
    
        return response()->json(['status' => 'unfollowed']);
    }
    
    

    


    public function show($id)
{
    $usuario = User::findOrFail($id);

    // Obter a quantidade de seguidores
    $followersCount = $usuario->seguidores()->count();

    return view('profile', compact('usuario', 'followersCount'));
}
}


