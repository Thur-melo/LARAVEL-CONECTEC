<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Adm;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //public function showHome()
public function showperfil(){
    $user = Auth::User();

    return view('perfil', compact('user'));
}

public function showprofile(){
    $user = Auth::User();

    return view('profile', compact('user'));
}

public function showPerguntas() {

    $user = Auth::user();
    $posts = Post::orderBy('created_at', 'desc')->get(); 
    $qnt_posts = Post::all()-> count();
    $qnt_info = Post::where('tipo_post', 'Informativo')-> count();
    $qnt_aula = Post::where('tipo_post', 'Aula')-> count();
    $qnt_duvida = Post::where('tipo_post', 'Duvida')-> count();
    $qnt_estagios = Post::where('tipo_post', 'Estagios')-> count();
    $qnt_postInativos = Post::where('status', 2)-> count();
    $qnt_postAtivos = Post::where('status', 1)-> count();



    $users = User::all();


    return view('adminHome', compact( 'user', 'posts', 'qnt_posts', 'qnt_info', 'qnt_duvida', 'qnt_estagios', 'qnt_aula', 'qnt_postInativos', 'qnt_postAtivos'));
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


public function update(Request $request, string $id)
{
    $profilePhotoUrl = 'urlDaFoto/default.jpg';
// Atualiza o usuário com os dados validados
$usuario = User::findOrFail($id);

    if ($request->hasFile('urlDaFoto')) {
        $file = $request->file('urlDaFoto');
        $profilePhotoUrl = $file->store('urlDaFoto', 'public');

    } elseif ($request->input('deleteImg')){

        $profilePhotoUrl = 'urlDaFoto/default.jpg';
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
        'perfil' => $request->input('role'),
       
    ]);

    return redirect()->route('loginAdm')->with([
        'status' => 'Usuário registrado com sucesso',
        'showModal' => true,
    ]);

    
    



    

     
 

}


public function loginAdm(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Buscando o administrador pelo email
    $adm = Adm::where('email', $credentials['email'])->first();

    // Verificando se o administrador existe e a senha está correta
    if ($adm && Hash::check($credentials['password'], $adm->password)) {
        // Autenticar o usuário
        Auth::login($adm);
        
        return redirect()->route('admin')->with(['success' => 'Logou']);
    }

    return redirect()->route('loginAdm')->withErrors(['error' => 'Email ou senha errada']);
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


