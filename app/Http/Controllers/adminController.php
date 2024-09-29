<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Adm;

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
    $qnt_users = User::all()-> count();
    $qnt_alunos = User::where('perfil', 'Aluno')-> count();
    $qnt_professores = User::where('perfil', 'professor')-> count();
    $qnt_outros = User::where('perfil', 'outros')-> count();
    $users = User::all();
    $usersAtivo = User::where('status', 1)-> get();


    return view('adminHome', compact( 'posts', 'qnt_users', 'usersAtivo', 'users', 'qnt_professores', 'qnt_alunos', 'qnt_outros' ));
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
    $qnt_alunos = User::where('perfil', 'Aluno')-> count();
    $qnt_professores = User::where('perfil', 'professor')-> count();
    $qnt_outros = User::where('perfil', 'outros')-> count();
    $users = User::all();
    $usersAtivo = User::where('status', 1)-> get();


    // $qnt_aprovados = Post::where('status', 2)-> count();

    // $qnt_pendentes = Post::where('status', 1)-> count();

    return view('admin', compact('qnt_users', 'usersAtivo', 'users', 'qnt_professores', 'qnt_alunos', 'qnt_outros' ));
}

public function registerAdm(Request $request)

{
    

    $profilePhotoUrl = null;

    if ($request->hasFile('urlDaFoto')) {
        $file = $request->file('urlDaFoto');
        $profilePhotoUrl = $file->store('urlDaFoto', 'public');
    }

    Adm::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'urlDaFoto' => $profilePhotoUrl,
        'modulo' => $request->input('module'),
        'perfil' => $request->input('role'),
       
    ]);

    return redirect()->route('loginAdm')->with([
        'status' => 'Usuário registrado com sucesso',
        'showModal' => true,
    ]);

    
    



    

     
 

}

public function loginAdm(Request $request){



    $credentials = $request->only('email','password');
    $autenticado =Auth::attempt($credentials);
    
       if(!$autenticado){
        

           return redirect()->route('loginAdm')->withErrors(['error' =>'Email ou senha errada']);

       }
       return redirect()->route('admin', )->with(['success' =>'Logou']);

   }

   public function showAdmForm()
   {
       return view('registerAdm');
   }

   public function showLoginAdmForm()
    {
         return view('loginAdm');
    }






    
public function desativaUser($id)
{
    
    $user = User::findOrFail($id); // Encontre o User$user pelo ID
    $user->status = 'Off'; // Muda o status para 2
    $user->save(); // Salva as alterações

    return redirect()->route('admin')->with('success', 'Status do post atualizado para 2!');
}



    public function AtivaUser($id)
    {
        
        $user = User::findOrFail($id); // Encontre o User$user pelo ID
        $user->status = 'Ativo'; // Muda o status para 2
        $user->save(); // Salva as alterações
    
        return redirect()->route('admin')->with('success', 'Status do post atualizado para 1!');
    }

}


