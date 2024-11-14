<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Seguir;
use Illuminate\Http\Request;
use App\Models\Adm;
use App\Models\PreferenciasLista;
use Illuminate\Support\Facades\Hash;
use App\Models\Denuncia;
use App\Models\DenunciaUsuario;

class adminController extends Controller
{
    //public function showHome()

    public function showdenuncias()    {
        // Obter todas as denúncias
        $denuncias = Denuncia::with(['user', 'post'])->get();

        // Retornar a view com os dados das denúncias
        return view('AdminDenuncias', compact('denuncias'));
    }

public function showperfil($id) {

    
    // Buscar usuário
    $usuario = User::findOrFail($id);
    $user = Auth::User();   
    $post = Post::all();

    // Buscar posts do user auth
    $posts = Post::where('user_id', $usuario->id)->get();

    // Contar seguidores e seguindo
    $myseguidores = Seguir::where('seguindo_id', $usuario->id)->count();
    $seguindo = Seguir::where('seguidor_id', $usuario->id)->count();

    return view('perfil', compact('usuario', 'posts', 'user', 'myseguidores','seguindo'));
}

public function showprofile(){
    $user = Auth::User();

    return view('profile', compact('user'));
}

public function showPerguntas() {

    $user = Auth::user();
    $posts = Post::orderBy('created_at', 'desc')->get(); 
    $qnt_posts = Post::all()-> count();
    $qnt_tipos = PreferenciasLista::all()-> count();
    $preferenciasLista = PreferenciasLista::all();

    $qnt_postTipo = Post::select('tipo_post', DB::raw('count(*) as total'))
    ->groupBy('tipo_post')
    ->get()
    ->keyBy('tipo_post');

    $qnt_postCursos = PreferenciasLista::select('curso', DB::raw('count(*) as total'))
        ->groupBy('curso')
        ->get()
        ->keyBy('curso');

    $qnt_aula = Post::where('tipo_post', 'Aula')-> count();
    $qnt_duvida = Post::where('tipo_post', 'Duvida')-> count();
    $qnt_estagios = Post::where('tipo_post', 'Estagios')-> count();
    $qnt_postInativos = Post::where('status', 2)-> count();
    $qnt_postAtivos = Post::where('status', 1)-> count();


        
           $denuncias = Denuncia::with(['user', 'post'])->get();
 



    $users = User::all();


    return view('adminHome', compact( 'user', 'posts', 'qnt_posts', 'qnt_postTipo',  'qnt_postCursos', 'qnt_duvida', 'qnt_estagios', 'qnt_aula', 'qnt_postInativos', 'qnt_postAtivos', 'qnt_tipos', 'preferenciasLista', 'denuncias'));
}

    public function showadmin(Request $request)
    {


        // Verifica se há uma pesquisa de postagens
    $searchTerm = $request->input('search'); 
        
        

            
    if ($searchTerm) {


  // Buscar usuários
  $users = User::where('name', 'like', '%' . $searchTerm . '%')
  ->orWhere('email', 'like', '%' . $searchTerm . '%')
  ->orWhere('arroba', 'like', '%' . ltrim($searchTerm, '@') . '%')
  ->get(); 


    }else{
        $users = User::all();// Contar total de usuários
       
    }
    $qnt_users = User::count();
        // qnt por curso
        $qnt_users_ads = User::where('perfil', 'Ds')->count();
        $qnt_users_adm = User::where('perfil', 'Adm')->count();
        $qnt_users_nutri = User::where('perfil', 'Nutri')->count();

    // Calcular porcentagens
    $porcentagem_ads = 0;
    $porcentagem_adm = 0;
    $porcentagem_nutri = 0;

    if ($qnt_users > 0) { // Para evitar divisão por zero
        $porcentagem_ads = ($qnt_users_ads / $qnt_users) * 100;
        $porcentagem_adm = ($qnt_users_adm / $qnt_users) * 100;
        $porcentagem_nutri = ($qnt_users_nutri / $qnt_users) * 100;
    }

        // Obter todos os usuários ativos
        $usersAtivo = User::where('status', 1)->get();

        // Carregar denúncias pendentes com eager loading
        $denunciasUser = DenunciaUsuario::with('user')->where('status', 'pendente')->get();

        // Contar o número de denúncias pendentes e bloqueadas
        $qnt_pendentes = $denunciasUser->count();
        $qnt_bloqueados = DenunciaUsuario::where('status', 'bloqueados')->count();

        // Contar seguidores para cada usuário
        $seguidoresCounts = Seguir::select('seguindo_id', DB::raw('count(*) as count'))
            ->groupBy('seguindo_id')
            ->pluck('count', 'seguindo_id');




      // Obtém os 10 usuários com mais seguidores
      $topUsers = User::select('users.id', 'users.name', DB::raw('COUNT(seguidores.id) as seguidores_count'))
      ->leftJoin('seguidores', 'seguidores.seguindo_id', '=', 'users.id')
      ->groupBy('users.id', 'users.name') // Adiciona 'users.name' na cláusula GROUP BY
      ->orderBy('seguidores_count', 'DESC')
      ->limit(10)
      ->get();

      $maisPost = User::withCount('posts')
      ->orderBy('posts_count', 'desc')
      ->take(3)
      ->get();
  
  // Prepare dados para a view
  $userNamesPost = $maisPost->pluck('arroba')->map(function ($arroba) {
    return '@' . $arroba; // Adiciona '@' a cada nome
})->toArray(); // Nomes dos usuários
  $userPostCounts = $maisPost->pluck('posts_count')->toArray(); 


// Controller
$maisComments = User::withCount('comentarios')
    ->orderBy('comentarios_count', 'desc')
    ->take(3)
    ->get();

// Extrair contagens de comentários
$userPostCounts = $maisComments->pluck('comentarios_count')->toArray();

// Extrair nomes dos usuários com '@'
$userNamesComment = $maisComments->pluck('arroba')->map(function ($arroba) {
    return '@' . $arroba; // Adiciona '@' a cada nome
})->toArray();
        // Passar os dados para a view
        return view('admin', compact('qnt_users', 'qnt_pendentes', 'seguidoresCounts', 'usersAtivo', 'denunciasUser', 'qnt_bloqueados',
        'users', 'qnt_users_ads', 'qnt_users_adm', 'qnt_users_nutri', 'porcentagem_ads','porcentagem_adm','porcentagem_nutri', 'topUsers', 'maisPost','userPostCounts', 'userNamesComment', 'userNamesPost', 'userPostCounts'));
    }


    


// Relacionamento com o usuário denunciado



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

    if ($request->hasFile('urlDoBanner')) {
        $file = $request->file('urlDoBanner');
        $profileBannerUrl = $file->store('urlDoBanner', 'public');

    } elseif ($request->input('deleteImg')){

        $profileBannerUrl = 'urlDoBanner/default-banner.jpg';
    } else {
          // Se não houver nova foto, mantém a URL existente
          $profileBannerUrl = $usuario->urlDoBanner;
    }




    $usuario->urlDoBanner= $profileBannerUrl;

$usuario->urlDaFoto= $profilePhotoUrl;

// Atualize os dados do usuário
$usuario->update($request->except('urlDaFoto', 'urlDoBanner'));



return redirect()->route('profile', ['id' => $usuario->id])->with('status', 'Usuário atualizado com sucesso');
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
    $user->status = 'inativo'; // Muda o status para 2
    $user->save(); // Salva as alterações

    return redirect()->route('admin')->with('success', 'Status do post atualizado para 2!');
}



public function AtivaUser(Request $request, $id)
{
    // Encontra o usuário pelo ID ou retorna erro 404
    $user = User::findOrFail($id);

    // Atualiza o status do usuário para 'Ativo'
    $user->status = 'Ativo';
    $user->save(); // Salva as alterações no banco de dados

    // Retorna uma resposta JSON de sucesso
    return response()->json(['message' => 'Usuário ativado com sucesso']);
}


    public function destroyPost($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->back()->with('success', 'Post deletado com sucesso!');
}

}


