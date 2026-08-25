<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserController extends Controller
{
    /**
     * Exibe a lista de usuários.
     */
    public function listUsersForm(Request $request)
    {
        $userFilter = $request->input('user_filter');
        $maxLevel = session('user_level', Auth::user()?->level);

        $query = User::query()
            ->orderBy('name')
            ->select('id', 'name', 'email', 'document_data');

        if ($maxLevel !== null) {
            $query->where('level', '<=', (int) $maxLevel);
        }

        if (!empty($userFilter)) {
            $query->where(function ($q) use ($userFilter) {
                $q->where('name', 'like', '%' . $userFilter . '%')
                  ->orWhere('email', 'like', '%' . $userFilter . '%')
                  ->orWhereRaw(
                      "CONVERT(JSON_UNQUOTE(document_data) USING utf8mb4) COLLATE utf8mb4_general_ci like ?",
                      ['%' . $userFilter . '%']
                  );


                  //   ->orWhereRaw(
                    //       "REPLACE(REPLACE(REPLACE(JSON_UNQUOTE(JSON_EXTRACT(document_data, '$.cpf')), '.', ''), '-', ''), ' ', '') like ?",
                    //       ['%' . preg_replace('/\D+/', '', $userFilter) . '%']
            });
        }
        $users = $query->paginate(10);

        return view('users.users_list', compact('users', 'userFilter'));
    }

    /**
     * Visualizar um usuário.
     */
    public function showUsersForm($id)
    {
        $user = User::findOrFail($id);
        // dd($user->data_flex);
        return view('users.users_show', compact('user'));
    }

    /**
     * Editar um usuário.
     */
    public function editUsersForm($id)
    {
        $user = User::findOrFail($id);
        return view('users.users_edit', compact('user'));
    }

/**
     * Editar um usuário (matrícula).
     */
    public function editUsersEnrollmentForm($id, $niche_id)
    {
        $user = User::findOrFail($id);
        return view('users.users_edit_neejacpdv', compact('user', 'niche_id'));
    }


    /**
     * Atualizar um usuário.
     */
    public function updateUsersForm(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $emailRule = 'required|string|email|max:255';
        if ($request->email !== $user->email) {
            // se o email do usuário foi alterado, adiciona a regra de unicidade (tem que ser único)
            $emailRule .= '|unique:users';
        }
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => $emailRule,
            'level'  => 'required|numeric|max:'.(Auth::user()->level),
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:100',
            'city'   => 'required|string|max:100',
            'state'  => 'required|string|max:50',
            'zip'    => 'required|string|max:20',
            'country'=> 'required|string|max:100',
            'cellphone' => 'required|string|max:30',
            'phone'     => 'required|string|max:30',
            'whatsapp'  => 'required|string|max:30',
            'telegram'  => 'required|string|max:150',
            'facebook'  => 'required|string|max:150',
            'instagram' => 'required|string|max:150',
            // 'ise_number' => 'required|string|max:20',
            'type'       => 'required|string|max:100',
            'social_name' => 'nullable|string|max:255',
            'doc_number' => 'required|string|max:100',
            'issuer'     => 'required|string|max:100',
            'birth'      => 'required|date',
            'birthplace' => 'required|string|max:100',
            'nationality' => 'required|string|max:100',
            'issue_date'  => 'required|date',
            'valid_to'    => 'required|date',
            'cnh'         => 'required|string|max:100',
            'rg'          => 'required|string|max:100',
            'cpf'         => 'required|string|max:100',
            'workcard'   => 'required|string|max:100',
            'election'   => 'required|string|max:100',
            'passport'   => 'required|string|max:100',
            'mother'     => 'required|string|max:255',
            'father'     => 'required|string|max:255',
            'marital'    => 'required|string|max:50',
            'profession' => 'required|string|max:100',
            'gender'     => 'required|string|max:30',
        ]);


        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->level = $validated['level'];

        $dataaddress = $request->only(['street', 'number', 'city', 'state', 'zip', 'country', 'cellphone', 'phone', 'whatsapp', 'telegram', 'facebook', 'instagram']);
        $user->address_data = $dataaddress;

        $datadocument = $request->only(['type', 'social_name', 'doc_number', 'issuer', 'birth', 'birthplace', 'nationality', 'issue_date', 'valid_to', 'cnh', 'rg', 'cpf', 'workcard', 'election', 'passport', 'mother', 'father', 'marital', 'profession', 'gender_identity', 'biological_sex']);
        $user->document_data = $datadocument;

        $user->save();
        return redirect()->route('users_edit.show', $user->id)->with('status', 'Usuário atualizado com sucesso.');
    
        }


    /**
     * Atualizar um usuário (matrícula).
     */
    public function updateUsersEnrollmentForm(Request $request, int $id, int $niche_id)
    {
        $user = User::findOrFail($id);
        $emailRule = 'required|string|email|max:255';
        if ($request->email !== $user->email) {
            // se o email do usuário foi alterado, adiciona a regra de unicidade (tem que ser único)
            $emailRule .= '|unique:users';
        }
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => $emailRule,
            'level'  => 'required|numeric|max:'.(Auth::user()->level),
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:100',
            'city'   => 'required|string|max:100',
            'state'  => 'required|string|max:50',
            'neighborhood_user' => 'nullable|string|max:50',
            'zip'    => 'required|string|max:20',
            'country'=> 'required|string|max:100',
            'cellphone' => 'required|string|max:30',
            'phone'     => 'nullable|string|max:30',
            'whatsapp'  => 'nullable|string|max:30',
            'telegram'  => 'nullable|string|max:150',
            'facebook'  => 'nullable|string|max:150',
            'instagram' => 'nullable|string|max:150',
            'type'       => 'required|string|max:100',
            'social_name' => 'nullable|string|max:255',
            'doc_number' => 'required|string|max:100',
            'issuer'     => 'required|string|max:100',
            'birth'      => 'required|date',
            'birthplace' => 'required|string|max:100',
            'nationality' => 'required|string|max:100',
            'issue_date'  => 'required|date',
            'valid_to'    => 'required|string|max:20',
            'cpf'         => 'required|string|max:100',
            'race'       => 'required|string|max:50',
            'mother'     => 'required|string|max:255',
            'father'     => 'required|string|max:255',
            'marital'    => 'required|string|max:50',
            'profession' => 'required|string|max:100',
            'gender_identity'     => 'required|string|max:30',
            'biological_sex'      => 'required|string|max:30',
            'profile_image' => 'nullable|image|mimes:jpeg,jpg|max:512', // Adicionando validação para imagem de perfil
            'photo_capture' => 'nullable|string',
            'profile_document' => 'nullable|file|mimes:jpeg,jpg,pdf|max:512', 
            'proof_of_schooling' => 'nullable|file|mimes:jpeg,jpg,pdf|max:512',
            'proof_of_residence' => 'nullable|file|mimes:jpeg,jpg,pdf|max:512',
        ]);

        $photoPath = null;

        // Mantém a foto atual por padrão, caso não venha nova foto no request
        $existingDocumentData = $user->document_data;
        if (is_string($existingDocumentData)) {
            $existingDocumentData = json_decode($existingDocumentData, true);
        }
        if (!is_array($existingDocumentData)) {
            $existingDocumentData = [];
        }
        $profile_image = $existingDocumentData['profile_image'] ?? null;

        // Se houver nova imagem (upload/câmera), remove todas as imagens antigas desse usuário.
        $hasNewImageInput = $request->hasFile('profile_image') || $request->filled('photo_capture');
        if ($hasNewImageInput) {
            $allFiles = Storage::disk('public')->files('users');
            $prefixUpl = 'users/user_' . $user->id . '_upl_';
            $prefixCam = 'users/user_' . $user->id . '_cam_';
            $toDelete = array_filter($allFiles, function ($path) use ($prefixUpl, $prefixCam) {
                return str_starts_with($path, $prefixUpl) || str_starts_with($path, $prefixCam);
            });
            if (!empty($toDelete)) {
                Storage::disk('public')->delete($toDelete);
            }
        }

        // 1) Upload normal
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $ext = $request->file('profile_image')->extension();
            $name = 'users/' . 'user_' . $user->id . uniqid('_upl_', true) . '.' . $ext;
            $request->file('profile_image')->storeAs('users', basename($name), 'public');
            $photoPath = $name;
        }

        // 2) Captura da câmera (base64)
        if (!$photoPath && $request->filled('photo_capture')) {
            $data = $request->input('photo_capture');
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $data = base64_decode($data);
                $ext = strtolower($type[1]) === 'png' ? 'png' : 'jpg';
                $name = 'users/' . 'user_' . $user->id . uniqid('_cam_', true) . '.' . $ext;
                Storage::disk('public')->put($name, $data);
                $photoPath = $name;
            }
        }

        $documentPath = null;
        $profile_document = $existingDocumentData['profile_document'] ?? null;
  
        $hasNewDocumentInput = $request->hasFile('profile_document');
        if ($hasNewDocumentInput) {
            $allFiles = Storage::disk('public')->files('users');
            $prefixUpl = 'users/user_' . $user->id . '_doc_';
            $toDelete = array_filter($allFiles, function ($path) use ($prefixUpl) {
                return str_starts_with($path, $prefixUpl);
            });
            if (!empty($toDelete)) {
                Storage::disk('public')->delete($toDelete);
            }
        }

        // 1) Upload normal
        if ($request->hasFile('profile_document') && $request->file('profile_document')->isValid()) {
            $ext = $request->file('profile_document')->extension();
            $name = 'users/' . 'user_' . $user->id . uniqid('_doc_', true) . '.' . $ext;
            $request->file('profile_document')->storeAs('users', basename($name), 'public');
            $documentPath = $name;
        }


        // proof_of_schooling
        $schoolingPath = null;
        $proof_of_schooling = $existingDocumentData['proof_of_schooling'] ?? null;
  
        $hasNewSchoolingInput = $request->hasFile('proof_of_schooling');
        if ($hasNewSchoolingInput) {
            $allFiles = Storage::disk('public')->files('users');
            $prefixUpl = 'users/user_' . $user->id . '_esc_';
            $toDelete = array_filter($allFiles, function ($path) use ($prefixUpl) {
                return str_starts_with($path, $prefixUpl);
            });
            if (!empty($toDelete)) {
                Storage::disk('public')->delete($toDelete);
            }
        }

        // 1) Upload normal
        if ($request->hasFile('proof_of_schooling') && $request->file('proof_of_schooling')->isValid()) {
            $ext = $request->file('proof_of_schooling')->extension();
            $name = 'users/' . 'user_' . $user->id . uniqid('_esc_', true) . '.' . $ext;
            $request->file('proof_of_schooling')->storeAs('users', basename($name), 'public');
            $schoolingPath = $name;
        }


        // proof_of_residence
        $residencePath = null;
        $proof_of_residence = $existingDocumentData['proof_of_residence'] ?? null;
  
        $hasNewResidenceInput = $request->hasFile('proof_of_residence');
        if ($hasNewResidenceInput) {
            $allFiles = Storage::disk('public')->files('users');
            $prefixUpl = 'users/user_' . $user->id . '_res_';
            $toDelete = array_filter($allFiles, function ($path) use ($prefixUpl) {
                return str_starts_with($path, $prefixUpl);
            });
            if (!empty($toDelete)) {
                Storage::disk('public')->delete($toDelete);
            }
        }

        // 1) Upload normal
        if ($request->hasFile('proof_of_residence') && $request->file('proof_of_residence')->isValid()) {
            $ext = $request->file('proof_of_residence')->extension();
            $name = 'users/' . 'user_' . $user->id . uniqid('_res_', true) . '.' . $ext;
            $request->file('proof_of_residence')->storeAs('users', basename($name), 'public');
            $residencePath = $name;
        }

        // Se houve nova foto, sobrescreve a atual
        if ($photoPath) {
            $profile_image = $photoPath;
        }
        // Se houve novo documento, sobrescreve o atual
        if ($documentPath) {
            // dd($documentPath);
            $profile_document = $documentPath;
        }
        // Se houve novo comprovante de escolaridade, sobrescreve o atual
        if ($schoolingPath) {
            $proof_of_schooling = $schoolingPath;
        }
        // Se houve novo comprovante de residência, sobrescreve o atual
        if ($residencePath) {
            $proof_of_residence = $residencePath;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->level = $validated['level'];

        $dataaddress = $request->only(['street', 'number', 'city', 'state', 'neighborhood_user', 'zip', 'country', 'cellphone', 'phone', 'whatsapp', 'telegram', 'facebook', 'instagram']);
        $user->address_data = $dataaddress;

        $datadocument = $request->only(['type', 'social_name', 'doc_number', 'issuer', 'birth', 'birthplace', 'nationality', 'issue_date', 'valid_to', 'cnh', 'rg', 'cpf', 'workcard', 'election', 'passport', 'mother', 'father', 'marital', 'profession', 'gender_identity', 'biological_sex', 'race']);
        $user->document_data = $datadocument;

        if (!empty($profile_image)) {
            $datadocument['profile_image'] = $profile_image;
        }
        // $user->document_data = $datadocument;

        if (!empty($profile_document)) {
            $datadocument['profile_document'] = $profile_document;
        }
        // $user->document_data = $datadocument;

        if (!empty($proof_of_schooling)) {
            $datadocument['proof_of_schooling'] = $proof_of_schooling;
        }
        // $user->document_data = $datadocument;

        if (!empty($proof_of_residence)) {
            $datadocument['proof_of_residence'] = $proof_of_residence;
        }


        $user->document_data = $datadocument;

        $user->save();
        return redirect()->route('users_edit_neejacpdv.show', [$user->id, $niche_id])->with('status', 'Usuário atualizado com sucesso.');
    
    }




    /**
     * Formulário para criar um novo usuário.
     */
    public function addUsersForm()
    {
        return view('users.users_create');
    }

    /**
     * Armazenar um novo usuário.
     */
    public function storeUsersForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address_data' => 'nullable|array',
            'document_data' => 'nullable|array',
    
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 0, // Nível padrão para novos usuários
            'address_data' => $request->address_data ?? [], // ou ajuste conforme necessário
            'document_data' => $request->document_data ?? [], // ou ajuste conforme necessário
        ]);
        return redirect()->route('users_list.show')->with('success', 'Usuário criado com sucesso.');
    }

    public function destroyUsersForm(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users_list.show')->with('status', 'Usuário excluído com sucesso.');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('users_list.show')->with('status', 'Violação de Integridade - Usuário não excluído.');
        }
    }
}
