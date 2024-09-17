<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

 //
 public function showHomeForm()
 {
     // Recupera todos os posts
     $posts = Post::all();

     // Passa os posts para a view
     return view('home', compact('posts'));
 }

 public function postar(Request $request)

 {

   
     Post::create([
         'content' => $request->input('content'),
     
        
     ]);

     return redirect()->route('home')->with('status', 'Post registrado com sucesso');
 }

}
 






 


