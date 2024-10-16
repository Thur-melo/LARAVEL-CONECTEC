<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Preferencia;
use App\Models\preferenciasLista;




class preferenciasController extends Controller
{


    public function showPreferencias(){
        $user = Auth::User();
        $preferenciasLista = PreferenciasLista::all();
        $preferenciasDoUsuario = $user->preferencia;

        return view('preferencias', compact('preferenciasLista', 'preferenciasDoUsuario'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'preferencias' => 'required|array|min:1',
            'nomePreferencias' => 'required|string',
        ]);
    
        $selectedPreferencias = $validatedData['preferencias'];
        $nomePreferencias = $validatedData['nomePreferencias'];
    
        foreach ($selectedPreferencias as $preferenciaId) {
            Preferencia::create([
                'user_id' => auth()->id(),
                'preferencia_id' => $preferenciaId,
                'nomePreferencia' => $nomePreferencias, // O nome completo das preferências
            ]);
        }
    
        return redirect()->route('perfil')->with('success', 'Preferências salvas com sucesso!');
    }
    

    // admin


    public function index()
    {
        $preferenciasLista = PreferenciasLista::all();

        return view('adminPreferencias', compact('preferenciasLista'));
    }


    public function storeLista(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:preferenciasLista|max:100',
        ]);

        PreferenciasLista::create([
            'name' => $request->input('name'),
        ]);



        return redirect()->route('preferenciasLista')->with('success', 'Preferência criada com sucesso!');
    }
    

}
