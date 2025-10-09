<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersDataFlex;
use Illuminate\Auth\Events\Registered;

class UsersDataFlexController extends Controller
{
    //
    /**
     * Exibe o formulário de habitats e nichos.
     */
    public function showHabitatsNichesForm()
    {
        $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
        return view('habitats_niches', compact('habitats'));
    }

    /**
     * Salva os nichos selecionados para o habitat.
     */
    public function saveHabitatsNiches(Request $request)
    {
        if($request->has('u_n_h_id')){
            $param = $request->input("u_n_h_id");
            // Decodifica o JSON e adiciona os campos ao request   
            $array = json_decode($param, true); // true retorna array associativo
            $request->merge([
                'user_id' => $array[0],
                'niche_id' => $array[1],
                'habitat_id' => $array[2],
            ]);

            $exists = UsersDataFlex::where('user_id', $array[0])
                ->where('niche_id', $array[1])
                ->where('habitat_id', $array[2])
                ->exists();

            if (!$exists) {
            
                $validated = $request->validate([
                    'user_id' => 'required|exists:users,id',
                    'niche_id' => 'required|exists:niches,id',
                    'habitat_id' => 'required|exists:habitats,id',
                ]);

                // Criação do registro
                $usersdf = UsersDataFlex::create([
                    'user_id' => Auth::user()->id,
                    'niche_id' => $request->niche_id,
                    'habitat_id' => $request->habitat_id,
                ]);
                event(new Registered($usersdf));

                return redirect()->route('dashboard')->with('success', 'Nicho salvo com sucesso!');
            } else {
                // Opcional: retornar erro para o usuário
                return back()->withErrors(['msg' => 'Registro já existe.']);
            }
        }else{
            // dd ($param);
            return redirect()->route('dashboard')->with('status', 'Nenhum nicho selecionado.');
        } 
    }
}
