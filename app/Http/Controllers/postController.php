<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class postController extends Controller
{

    
    public function postar(Request $request)
    
    {
        $profilePhotoPost = null;
    
        if ($request->hasFile('fotoPost')) {
            $file = $request->file('fotoPost');
            $profilePhotoPost = $file->store('fotoPost', 'public');
        }


        Post::create([
            'texto' => $request->input('texto'),
            'user_id' => Auth::id(),  
            'fotoPost' =>  $profilePhotoPost,

        
     ]);

     return redirect()->route('home')->with('status', 'Post registrado com sucesso');
 }

}
