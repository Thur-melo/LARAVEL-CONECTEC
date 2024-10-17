<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Preferencia;
use App\Models\preferenciasLista;
use App\Models\Post;
use Illuminate\Support\Facades\DB;






class preferenciasController extends Controller
{


    public function showPreferencias()
    {
        $user = Auth::User();
        $userId = auth()->id();
        $preferenciasLista = PreferenciasLista::all();
        $preferenciasListaDS = PreferenciasLista::where('curso', 'D.S')->get();
        $preferenciasListaNutri = PreferenciasLista::where('curso', 'Nutrição')->get();
        $preferenciasListaADM = PreferenciasLista::where('curso', 'ADM')->get();
        $preferenciasListaOutro = PreferenciasLista::where('curso', 'Outro')->get();
        $preferenciasUser = Preferencia::where('user_id', $userId)->get();


    

        return view('preferencias', compact('user', 'preferenciasUser', 'preferenciasLista', 'preferenciasListaDS', 'preferenciasListaNutri', 'preferenciasListaADM', 'preferenciasListaOutro'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'preferencias' => 'required|array|min:1',
        ]);

        $userId = auth()->id(); // Obtém o ID do usuário autenticado

        // Loop pelas preferências selecionadas
        foreach ($validatedData['preferencias'] as $preferenciaId) {
            // Encontra a preferência pelo ID
            $preferencia = PreferenciasLista::find($preferenciaId);

            // Verifica se a preferência foi encontrada
            if ($preferencia) {
                // Verifica se a preferência já existe para o usuário
                $existingPreference = Preferencia::where('user_id', $userId)
                    ->where('preferencia_id', $preferenciaId)
                    ->first();

                // Se a preferência não existir, cria uma nova entrada
                if (!$existingPreference) {
                    Preferencia::create([
                        'user_id' => $userId,
                        'preferencia_id' => $preferenciaId,
                        'nomePreferencia' => $preferencia->name, // Armazena o nome da preferência
                    ]);
                }
            }
        }

        return redirect()->route('perfil')->with('success', 'Preferências salvas com sucesso!');
    }



    public function destroyPreferencia($preferenciaId)
    {
        $userId = auth()->id(); // Obtém o ID do usuário autenticado

        // Encontra a preferência a ser desassociada
        $preferencia = Preferencia::where('user_id', $userId)
            ->where('preferencia_id', $preferenciaId)
            ->first();

        // Verifica se a preferência foi encontrada
        if ($preferencia) {
            $preferencia->delete(); // Exclui o relacionamento
            return redirect()->route('perfil')->with('success', 'Preferência desassociada com sucesso!');
        }

        return redirect()->route('perfil')->with('error', 'Preferência não encontrada.');
    }




















    // admin


    public function index(Request $request)
    {
        $qnt_preferencia = preferenciasLista::all()->count();
        $qnt_DS = preferenciasLista::where('curso', 'D.S')->count();
        $qnt_Nutri = preferenciasLista::where('curso', 'Nutrição')->count();
        $qnt_ADM = preferenciasLista::where('curso', 'ADM')->count();
        $qnt_Outro = preferenciasLista::where('curso', 'Outro')->count();
        $preferenciasListaDS = PreferenciasLista::where('curso', 'D.S')->get();
        $preferenciasListaNutri = PreferenciasLista::where('curso', 'Nutrição')->get();
        $preferenciasListaADM = PreferenciasLista::where('curso', 'ADM')->get();
        $preferenciasListaOutro = PreferenciasLista::where('curso', 'Outro')->get();


        if ($request->has('s')) {
            $preferenciasLista = preferenciasLista::search($request->input('s'));
        } else {
            $preferenciasLista = preferenciasLista::all();
        }

             // Obter contagem de preferências por curso
    $qnt_postCursos = PreferenciasLista::select('curso', DB::raw('count(*) as total'))
    ->whereIn('curso', ['D.S', 'Nutrição', 'ADM'])
    ->groupBy('curso')
    ->get()
    ->keyBy('curso');

// Obter contagem de postagens por tipo
$qnt_postTipo = Post::select('tipo_post', DB::raw('count(*) as total'))
    ->groupBy('tipo_post')
    ->get()
    ->keyBy('tipo_post');

        return view('adminPreferencias', compact(
            'preferenciasLista',
            'qnt_preferencia',
            'qnt_DS',
            'qnt_Nutri',
            'qnt_ADM',
            'qnt_Outro',
            'preferenciasListaDS',
            'preferenciasListaNutri',
            'preferenciasListaADM',
            'preferenciasListaOutro',
            'qnt_postCursos', 'qnt_postTipo', 
        ));
    }


    public function storeLista(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:preferenciasLista|max:100',
            'curso' => 'required|string',
        ]);

        PreferenciasLista::create([

            'name' => $request->input('name'),
            'curso' => $request->input('curso'),

        ]);



        return redirect()->route('preferenciasLista')->with('success', 'Preferência criada com sucesso!');
    }



    public function destroy($id)
    {
        $preferencia = preferenciasLista::findOrFail($id);
        $preferencia->delete();

        return redirect()->route('preferenciasLista')->with('success', 'Post deletado com sucesso!');
    }
}
