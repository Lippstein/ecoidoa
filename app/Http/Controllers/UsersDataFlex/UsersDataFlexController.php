<?php

namespace App\Http\Controllers\UsersDataFlex;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\UsersDataFlex;
use Illuminate\Auth\Events\Registered;

class UsersDataFlexController extends Controller
{

    /**
    * Exibe o formulário para escolher habitat e nicho.
    */ 
    public function showHabitatsNichesForm()
    {
        $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
        $niches = \App\Models\Niche::select('id','niche','niche_data')->get();
        return view('usersDataFlex.habitats_niches', compact('habitats', 'niches'));
    }


    /**
     * Salva a escolha de habitat e nicho do usuário e cria um novo perfil.
     */
    public function saveHabitatsNiches(Request $request)
    { 
        $cvt = UsersDataFlex::select('user_id', 'user_profile')
            ->get()
            ->map(function ($row) {
                $userProfile = $row->user_profile;

                if (is_string($userProfile)) {
                    $decodedProfile = json_decode($userProfile, true);
                    $userProfile = is_array($decodedProfile) ? $decodedProfile : [];
                }

                $invite = '';
                if (is_array($userProfile)) {
                    $invite = (string) ($userProfile['invite'] ?? '');
                }

                return [
                    'user_id' => $row->user_id,
                    'invite' => $invite,
                ];
            })
            ->toArray();

        $data = json_decode($request->input('u_n_h_id'), true);
        $n_id = $data['n_id'];
        $h_id = $data['h_id'];
        $invite_3 = trim($request->input('invite_3'));
        $invite_4 = trim($request->input('invite_4'));
        // validação: note 'exists:table,id' usando o nome da coluna no DB
        $validator = Validator::make($data, [
            'n_id' => 'required|integer|exists:niches,id',
            'h_id' => 'required|integer|exists:habitats,id',
            'invite_3' => 'nullable|string',
            'invite_4' => 'nullable|string',
        ]);
        $validated = $validator->validate(); // lança ValidationException em caso de erro
        // normaliza/force o tipo
        $nicheId = (int) $validated['n_id'];
        $habitatId = (int) $validated['h_id'];
        if($nicheId == 3) {
            $invited_by = $invite_3 ?? null;
        } elseif($nicheId == 4) {
            $invited_by = $invite_4 ?? null;
        } else {
            $invited_by = null;
        }

        $inviteFound = false;
        $inviteOfUser = '0'; // valor padrão caso não encontre o convite
        foreach ($cvt as $item) {
            if ((string) (strtoupper($item['invite'] ?? '')) === (string) (strtoupper($invited_by ?? ''))) {
                $inviteFound = true;
                $inviteOfUser = $item['user_id'];
                break;
            }
        }

        if ((($nicheId == 3) || ($nicheId == 4)) && !$inviteFound) {
            return redirect()->back()
                ->withErrors(['invited_by' => 'Convite inválido para este nicho.'])
                ->withInput();
        }


        // salvar
        $userDataFlex = new UsersDataFlex();
        $userDataFlex->user_id = Auth::id();
        $userDataFlex->niche_id = $nicheId;
        $userDataFlex->habitat_id = $habitatId;
        $userDataFlex->user_profile = [
            'invited_by' => $inviteOfUser,
        ];
        $userDataFlex->save();
        event(new Registered(Auth::user()));
        return redirect()->route('dashboard')
            ->with('status', 'Perfil criado com sucesso! Agora você pode preencher os detalhes do seu perfil.');
    }  


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
        return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_edit", compact('userDataFlex', 'user', 'niche'));
    }


    /**
     * Atualizar profile (user data flex).
     */
    public function updateUsersDataFlexForm(Request $request, $id)
    {
        if (now('America/Sao_Paulo')->hour > 19 && now('America/Sao_Paulo')->hour < 22) {
            return redirect()->back()
                ->with('status', 'O sistema de atualização de perfil NÃO está disponível entre 19h e 22h.');
        }

        $userDataFlex = UsersDataFlex::findOrFail($id);
        $idNiche = $userDataFlex->niche_id;
        if($idNiche == 1) {
            $validated = $request->validate([
                    'nicheLevel' => 'nullable|integer|min:0|max:9',
                    'certificationEFSI' => 'required|string|max:150',
                    'conclusionCertificationEFSI' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'],
                    'ak1EFSIName' => 'required|string|max:150',
                    'ak1EFSIDescription' => 'required|string|max:150',
                    'ak1EFSIResult' => 'nullable|string|max:5',
                    'ak1EFSIConclusion' => 'nullable|string|max:10',
                    'ak1EFSIObs' => 'nullable|string|max:150',
                    'certificationEFSF' => 'required|string|max:150', 
                    'conclusionCertificationEFSF' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'], 
                    'ak1EFSFName' => 'required|string|max:150',
                    'ak1EFSFDescription' => 'required|string|max:150',
                    'ak1EFSFResult' => 'nullable|string|max:5',
                    'ak1EFSFConclusion' => 'nullable|string|max:10',
                    'ak1EFSFObs' => 'nullable|string|max:150',
                    'ak2EFSFName' => 'required|string|max:150', 
                    'ak2EFSFDescription' => 'required|string|max:150',
                    'ak2EFSFResult' => 'nullable|string|max:5',
                    'ak2EFSFConclusion' => 'nullable|string|max:10',
                    'ak2EFSFObs' => 'nullable|string|max:150',
                    'ak3EFSFName' => 'required|string|max:150',
                    'ak3EFSFDescription' => 'required|string|max:150',
                    'ak3EFSFResult' => 'nullable|string|max:5',        
                    'ak3EFSFConclusion' => 'nullable|string|max:10',
                    'ak3EFSFObs' => 'nullable|string|max:150',
                    'ak4EFSFName' => 'required|string|max:150',
                    'ak4EFSFDescription' => 'required|string|max:150',
                    'ak4EFSFResult' => 'nullable|string|max:5',
                    'ak4EFSFConclusion' => 'nullable|string|max:10',
                    'ak4EFSFObs' => 'nullable|string|max:150',
                    'certificationEMAF' => 'required|string|max:150',    
                    'conclusionCertificationEMAF' => ['nullable', 'string', 'regex:/^(?:19\d{2}|20\d{2}|Cursando)$/'],
                    'ak1EMAFName' => 'required|string|max:150',
                    'ak1EMAFDescription' => 'required|string|max:150',
                    'ak1EMAFResult' => 'nullable|string|max:5',
                    'ak1EMAFConclusion' => 'nullable|string|max:10',
                    'ak1EMAFObs' => 'nullable|string|max:150',
                    'ak2EMAFName' => 'required|string|max:150',
                    'ak2EMAFDescription' => 'required|string|max:150',
                    'ak2EMAFResult' => 'nullable|string|max:5',
                    'ak2EMAFConclusion' => 'nullable|string|max:10',
                    'ak2EMAFObs' => 'nullable|string|max:150',
                    'ak3EMAFName' => 'required|string|max:150',
                    'ak3EMAFDescription' => 'required|string|max:150',
                    'ak3EMAFResult' => 'nullable|string|max:5',        
                    'ak3EMAFConclusion' => 'nullable|string|max:10',
                    'ak3EMAFObs' => 'nullable|string|max:150',
                    'ak4EMAFName' => 'required|string|max:150',
                    'ak4EMAFDescription' => 'required|string|max:150',
                    'ak4EMAFResult' => 'nullable|string|max:5',
                    'ak4EMAFConclusion' => 'nullable|string|max:10',
                    'ak4EMAFObs' => 'nullable|string|max:150'
                ]);
        } elseif($idNiche == 2) {
            $validated = $request->validate([
                    // 'lotteryNumbers' => 'required|array|size:5',
                    // 'availableBalance' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                    // 'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                    // 'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                ]);
        } elseif($idNiche == 3) {
            $validated = $request->validate([
                'maintenance' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'lotteryNumbersUser' => 'required|array|size:5',
                'availableBalance' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'invite' => ['required', 'string', 'max:30']
                ]);

        } elseif($idNiche == 4) {
            $validated = $request->validate([
                'maintenance' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'lotteryNumbersUser' => 'required|array|size:5',
                'availableBalance' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'invite' => ['required', 'string', 'max:30']
                ]);
        } else {
            return redirect()->back()
                ->withErrors(['niche_id' => 'Nicho inválido.'])
                ->withInput();
        }

        $currentProfile = $userDataFlex->user_profile;
        if (is_string($currentProfile)) {
            $decodedProfile = json_decode($currentProfile, true);
            $currentProfile = is_array($decodedProfile) ? $decodedProfile : [];
        }
        if (!is_array($currentProfile)) {
            $currentProfile = [];
        }

        $updatedProfile = $currentProfile;
        foreach ($validated as $key => $value) {
            if ($key === 'nicheLevel') {
                continue;
            }
            if (!array_key_exists($key, $updatedProfile) || $updatedProfile[$key] !== $value) {
                $updatedProfile[$key] = $value;
            }
        }

        if ($request->filled('nicheLevel')) {
            $userDataFlex->niche_level = (int) $request->input('nicheLevel');
        }

        $userDataFlex->user_profile = $updatedProfile;
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
        $niche = $profiles->first()->niche;
        return view("usersDataFlex.usersDataFlex_list", compact('profiles', 'user_id', 'name', 'user'));
        // return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_list", compact('profiles', 'user_id', 'name', 'user'));
    }

    /**
     * Lista os registros de users_data_flex do usuário especificado.
     */
    public function resultadosUsersDataFlexForm($user_id, $niche_id)
    {
        $user = \App\Models\User::findOrFail($user_id);
        $userDataFlex = UsersDataFlex::with(['habitat', 'niche'])
            ->where('user_id', $user_id)
            ->where('niche_id', $niche_id)
            ->firstOrFail();
        return view("usersDataFlex.niche_{$niche_id}.usersDataFlex_resultados", compact('userDataFlex', 'user', 'user_id', 'niche_id'));
    }



}
