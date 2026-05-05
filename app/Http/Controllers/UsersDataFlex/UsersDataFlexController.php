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
        $data = json_decode($request->input('u_n_h_id'), true);
        $n_id = $data['n_id'];
        $h_id = $data['h_id'];
        $invite_3 = $request->input('invite_3');
        $invite_4 = $request->input('invite_4');
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
        $invite_3 = $request->input('invite_3') ? trim($request->input('invite_3')) : null;
        $invite_4 = $request->input('invite_4') ? trim($request->input('invite_4')) : null;
        // dd(strtoupper($invite_3), strtoupper($invite_4));
        if(($n_id == 3 && strtoupper($invite_3) !== 'HABITATDEADULTOS') || ($n_id == 4 && strtoupper($invite_4) !== 'HABITATDEADULTOS')) {
            return redirect()->back()
                ->withErrors(['invite' => 'Convite inválido para este nicho.'])
                ->withInput();
        }

        // salvar
        $userDataFlex = new UsersDataFlex();
        $userDataFlex->user_id = Auth::id();
        $userDataFlex->niche_id = $nicheId;
        $userDataFlex->habitat_id = $habitatId;
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
        return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_edit", compact('userDataFlex', 'user','niche'));
    }


    /**
     * Atualizar profile (user data flex).
     */
    public function updateUsersDataFlexForm(Request $request, $id)
    {
        $userDataFlex = UsersDataFlex::findOrFail($id);
        $idNiche = $userDataFlex->niche_id;
        if($idNiche == 1) {
            $validated = $request->validate([
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
                    'lotteryNumbers' => 'required|array|size:5',
                    'availableBalance' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                    'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                    'indebtedUsers' => 'required|string|max:150',
                    'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                    'creditorUsers' => 'required|string|max:150',
                    'results' => 'required|string|max:150'
                ]);
        } elseif($idNiche == 3) {
            // $lotteryNumbers = isset($data['lotteryNumbers']) ? $data['lotteryNumbers'] : 'Números não cadastrados'; 
            // $availableBalance = isset($data['availableBalance']) ? $data['availableBalance'] : 'Saldo não cadastrado';
            // $totalCredits = isset($data['totalCredits']) ? $data['totalCredits'] : 'Total de Créditos'; 
            // $indebtedUsers = isset($data['indebtedUsers']) ? $data['indebtedUsers'] : 'Usuários Devedores';
            // $totalDebts = isset($data['totalDebts']) ? $data['totalDebts'] : 'Total de Débitos'; 
            // $creditorUsers = isset($data['creditorUsers']) ? $data['creditorUsers'] : 'Usuários Credores';
            // $results = isset($data['results']) ? $data['results'] : 'Resultados não cadastrados';

            $validated = $request->validate([
                'lotteryNumbers' => 'required|array|size:5',
                'availableBalance' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                // 'indebtedUsers' => 'required|string|max:150',
                'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                // 'creditorUsers' => 'required|string|max:150',
                // 'results' => 'required|string|max:150'
                ]);
        } elseif($idNiche == 4) {
            // $lotteryNumbers = isset($data['lotteryNumbers']) ? $data['lotteryNumbers'] : 'Números não cadastrados'; 
            // $availableBalance = isset($data['availableBalance']) ? $data['availableBalance'] : 'Saldo não cadastrado';
            // $totalCredits = isset($data['totalCredits']) ? $data['totalCredits'] : 'Total de Créditos'; 
            // $indebtedUsers = isset($data['indebtedUsers']) ? $data['indebtedUsers'] : 'Usuários Devedores';
            // $totalDebts = isset($data['totalDebts']) ? $data['totalDebts'] : 'Total de Débitos'; 
            // $creditorUsers = isset($data['creditorUsers']) ? $data['creditorUsers'] : 'Usuários Credores';
            // $results = isset($data['results']) ? $data['results'] : 'Resultados não cadastrados';

            $validated = $request->validate([
                'lotteryNumbers' => 'required|array|size:5',
                'availableBalance' => ['nullable', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'totalCredits' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'indebtedUsers' => 'required|string|max:150',
                'totalDebts' => ['required', 'numeric', 'regex:/^\d+(\.\d{2})?$/'],
                'creditorUsers' => 'required|string|max:150',
                'results' => 'required|string|max:150'
                ]);
        } else {
            return redirect()->back()
                ->withErrors(['niche_id' => 'Nicho inválido.'])
                ->withInput();
        }

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
        $niche = $profiles->first()->niche;
        return view("usersDataFlex.niche_{$niche->id}.usersDataFlex_list", compact('profiles', 'user_id', 'name', 'user'));
    }

}
