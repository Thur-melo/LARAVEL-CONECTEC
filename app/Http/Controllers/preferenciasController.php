<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Preferencia;




class preferenciasController extends Controller
{


    public function showPreferencias(){
        $user = Auth::User();
    
        return view('preferencias', );
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
    


}
