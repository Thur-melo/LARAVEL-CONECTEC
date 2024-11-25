<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Certifique-se de incluir o modelo User
use App\Models\DenunciaUsuario;
use App\Models\Seguir; // Outros imports
use App\Models\Hashtag; // Outros imports

use Illuminate\Support\Facades\DB; // Importa a classe DB


class BuscarUsuariosController extends Controller // Renomeando a classe
{
    public function buscarUsuarios(Request $request)
    {
        $usuariosSugestoes = User::inRandomOrder()->limit(5)->get();

        $user = Auth::user();
       // Verifica se há uma pesquisa de postagens
       $searchTerm = $request->input('s'); 
        
        

            
           // Buscar usuários
           $users = User::where('name', 'like', '%' . $searchTerm . '%')
           ->orWhere('email', 'like', '%' . $searchTerm . '%')
           ->orWhere('arroba', 'like', '%' . ltrim($searchTerm, '@') . '%')
           ->get(); 

           
        $cardHashtags = Hashtag::withCount('posts')
        ->orderBy('posts_count', 'desc')
        ->take(3) // Limitando a 3 hashtags
        ->get();

        // Retornar a view com os usuários encontrados e o termo de busca
        return view('users', compact('users','cardHashtags', 'user', 'searchTerm', 'usuariosSugestoes'));
    }

    public function buscarUsuariosAdmin(Request $request)
    {
        // Inicializa a busca e filtros
        $searchTerm = $request->input('search', ''); // Se não houver, define como string vazia
        $statusFilter = $request->input('status', ''); // Filtro por status (ativo/inativo)
        $perfilFilter = $request->input('perfil', ''); // Filtro por perfil
    
        // Inicia a query de usuários
        $query = User::query();
    
        // Aplica filtros de busca
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('arroba', 'like', '%' . ltrim($searchTerm, '@') . '%');
            });
        }
    
        // Filtro por status
        if ($statusFilter !== '') {
            $query->where('status', $statusFilter);
        }
    
        // Filtro por perfil
        if ($perfilFilter !== '') {
            $query->where('perfil', $perfilFilter);
        }
    
        // Executa a consulta e obtém os resultados
        $users = $query->get();
      
        $users = User::all();// Contar total de usuários
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
  


        // Passar os dados para a view
        return view('admin', compact('qnt_users', 'qnt_pendentes', 'seguidoresCounts', 'usersAtivo', 'denunciasUser', 'qnt_bloqueados',
        'users', 'qnt_users_ads', 'qnt_users_adm', 'qnt_users_nutri', 'porcentagem_ads','porcentagem_adm','porcentagem_nutri', 'topUsers', 'users', 'searchTerm', 'statusFilter', 'perfilFilter'));
    }
   
    


}
