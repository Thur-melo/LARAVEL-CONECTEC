<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //public function showHome()
public function showperfil(){
    $user = Auth::User();

    return view('perfil', compact('user'));
}

public function showPerguntas() {

    $user = Auth::user();
    $posts = Post::with('user')->where('status', 1)->get(); // Combina as duas consultas

    return view('adminHome', compact('user', 'posts')); // Usa compact corretamente
}


public function update(Request $request, string $id)
{
    $profilePhotoUrl = null;
// Atualiza o usuário com os dados validados
$usuario = User::findOrFail($id);

    if ($request->hasFile('urlDaFoto')) {
        $file = $request->file('urlDaFoto');
        $profilePhotoUrl = $file->store('urlDaFoto', 'public');

    } elseif ($request->input('deleteImg')){

        $profilePhotoUrl = null;

    } else {
          // Se não houver nova foto, mantém a URL existente
          $profilePhotoUrl = $usuario->urlDaFoto;
    }
    
    


$usuario->urlDaFoto= $profilePhotoUrl;

// Atualize os dados do usuário
$usuario->update($request->except('urlDaFoto'));


return redirect()->route('perfil')->with('status', 'Usuário atualizado com sucesso');
}


public function contarProdutos()
{
  
}

public function showadmin(){
    // $user = Auth::User();

    $qnt_users = User::all()-> count();

    $qnt_aprovados = Post::where('status', 2)-> count();

    $qnt_pendentes = Post::where('status', 1)-> count();




    return view('admin', compact('qnt_users', 'qnt_aprovados', 'qnt_pendentes'));
}



}
