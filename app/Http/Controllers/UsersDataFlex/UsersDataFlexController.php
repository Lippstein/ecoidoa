<?php

namespace App\Http\Controllers\UsersDataFlex;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersDataFlex;
use Illuminate\Auth\Events\Registered;

class UsersDataFlexController extends Controller
{

    /**
     * Visualizar um perfil de usuário.
     */
    public function showUsersDataFlexForm($id)
    {
        $userDataFlex = UsersDataFlex::findOrFail($id);
        $user = \App\Models\User::findOrFail($userDataFlex->user_id);
        $niche = \App\Models\Niche::findOrFail($userDataFlex->niche_id);
        return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_show", compact('id','userDataFlex', 'user', 'niche'));
    }

    /**
     * Editar um Perfil.
     */
    public function editUsersDataFlexForm($id)
    {
        $userDataFlex = UsersDataFlex::findOrFail($id);
        $user = \App\Models\User::findOrFail($userDataFlex->user_id);
        $niche = \App\Models\Niche::findOrFail($userDataFlex->niche_id);
        return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_edit", compact('userDataFlex', 'user','niche'));
    }


    /**
     * Atualizar profile (user data flex).
     */
    public function updateUsersDataFlexForm(Request $request, $id)
    {
        $userDataFlex = UsersDataFlex::findOrFail($id);
        $validated = $request->validate([
                'certificationEFSI' => 'required|string|max:100',
                'conclusionCertificationEFSI' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'],
                'ak1EFSIName' => 'required|string|max:100',
                'ak1EFSIDescription' => 'required|string|max:100',
                'ak1EFSIResult' => 'nullable|string|max:100',
                'ak1EFSIConclusion' => 'nullable|string|max:100',
                'ak1EFSIObs' => 'nullable|string|max:100',
                'certificationEFSF' => 'required|string|max:100', 
                'conclusionCertificationEFSF' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'], 
                'ak1EFSFName' => 'required|string|max:100',
                'ak1EFSFDescription' => 'required|string|max:100',
                'ak1EFSFResult' => 'nullable|string|max:100',
                'ak1EFSFConclusion' => 'nullable|string|max:100',
                'ak1EFSFObs' => 'nullable|string|max:100',
                'ak2EFSFName' => 'required|string|max:100', 
                'ak2EFSFDescription' => 'required|string|max:100',
                'ak2EFSFResult' => 'nullable|string|max:100',
                'ak2EFSFConclusion' => 'nullable|string|max:100',
                'ak2EFSFObs' => 'nullable|string|max:100',
                'ak3EFSFName' => 'required|string|max:100',
                'ak3EFSFDescription' => 'required|string|max:100',
                'ak3EFSFResult' => 'nullable|string|max:100',        
                'ak3EFSFConclusion' => 'nullable|string|max:100',
                'ak3EFSFObs' => 'nullable|string|max:100',
                'ak4EFSFName' => 'required|string|max:100',
                'ak4EFSFDescription' => 'required|string|max:100',
                'ak4EFSFResult' => 'nullable|string|max:100',
                'ak4EFSFConclusion' => 'nullable|string|max:100',
                'ak4EFSFObs' => 'nullable|string|max:100',
                'certificationEMAF' => 'required|string|max:100',    
                'conclusionCertificationEMAF' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'],
                'ak1EMAFName' => 'required|string|max:100',
                'ak1EMAFDescription' => 'required|string|max:100',
                'ak1EMAFResult' => 'nullable|string|max:100',
                'ak1EMAFConclusion' => 'nullable|string|max:100',
                'ak1EMAFObs' => 'nullable|string|max:100',
                'ak2EMAFName' => 'required|string|max:100',
                'ak2EMAFDescription' => 'required|string|max:100',
                'ak2EMAFResult' => 'nullable|string|max:100',
                'ak2EMAFConclusion' => 'nullable|string|max:100',
                'ak2EMAFObs' => 'nullable|string|max:100',
                'ak3EMAFName' => 'required|string|max:100',
                'ak3EMAFDescription' => 'required|string|max:100',
                'ak3EMAFResult' => 'nullable|string|max:100',        
                'ak3EMAFConclusion' => 'nullable|string|max:100',
                'ak3EMAFObs' => 'nullable|string|max:100',
                'ak4EMAFName' => 'required|string|max:100',
                'ak4EMAFDescription' => 'required|string|max:100',
                'ak4EMAFResult' => 'nullable|string|max:100',
                'ak4EMAFConclusion' => 'nullable|string|max:100',
                'ak4EMAFObs' => 'nullable|string|max:100'
            ]);
        $userDataFlex->user_profile = $validated;
        $userDataFlex->save();
        return redirect()->route('usersDataFlex_edit.show', $userDataFlex->id)
            ->with('status', 'Perfil atualizado com sucesso!');
    }


    /**
     * Lista os registros de users_data_flex do usuário especificado.
     */
    public function listUsersDataFlexForm($id)
    {
        $user_id = $id;
        $user = \App\Models\User::findOrFail($id);
        $name = $user->name;
        $profiles = UsersDataFlex::with(['habitat', 'niche'])
            ->where('user_id', $id)
            ->paginate(10);
        return view('usersDataFlex.usersDataFlex_list', compact('profiles', 'user_id', 'name', 'user'));
    }

}
