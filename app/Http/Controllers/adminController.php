<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //public function showHome()
public function showadmin(){
    $user = Auth::User();

    return view('admin', compact('user'));
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


return redirect()->route('admin')->with('status', 'Usuário atualizado com sucesso');
}


}
