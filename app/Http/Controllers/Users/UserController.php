<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Exibe a lista de usuários.
     */
    public function listUsersForm()
    {
        $users = User::orderBy('name')->select('id','name','email')->paginate(10);
        return view('users.users_list', compact('users'));
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
            'type'       => 'required|string|max:100',
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

        // $street = isset($data['street']) ? $data['street'] : 'Rua não cadastrada';
        // $number = isset($data['number']) ? $data['number'] : 'Número não cadastrado';
        // $city = isset($data['city']) ? $data['city'] : 'Cidade não cadastrada';
        // $state = isset($data['state']) ? $data['state'] : 'Estado não cadastrado';
        // $zip = isset($data['zip']) ? $data['zip'] : 'CEP não cadastrado';
        // $country = isset($data['country']) ? $data['country'] : 'País não cadastrado';
        // $cellphone = isset($data['cellphone']) ? $data['cellphone'] : 'Celular não cadastrado';
        // $phone = isset($data['phone']) ? $data['phone'] : 'Telefone não cadastrado';
        // $whatsapp = isset($data['whatsapp']) ? $data['whatsapp'] : 'WhatsApp não cadastrado';
        // $telegram = isset($data['telegram']) ? $data['telegram'] : 'Telegram não cadastrado';
        // $facebook = isset($data['facebook']) ? $data['facebook'] : 'Facebook não cadastrado';
        // $instagram = isset($data['instagram']) ? $data['instagram'] : 'Instagram não cadastrado';
        // $type = isset($dataDoc['type']) ? $dataDoc['type'] : 'Tipo de documento não cadastrado';
        // $doc_number = isset($dataDoc['doc_number']) ? $dataDoc['doc_number'] : 'Número de documento não cadastrado';
        // $issuer = isset($dataDoc['issuer']) ? $dataDoc['issuer'] : 'Órgão emissor não cadastrado';
        // $birth = isset($dataDoc['birth']) ? $dataDoc['birth'] : 'Data de nascimento não cadastrada';
        // $birthplace = isset($dataDoc['birthplace']) ? $dataDoc['birthplace'] : 'Local de nascimento não cadastrado';
        // $nationality = isset($dataDoc['nationality']) ? $dataDoc['nationality'] : 'Nacionalidade não cadastrada';
        // $issue_date = isset($dataDoc['issue_date']) ? $dataDoc['issue_date'] : 'Data de emissão não cadastrada';
        // $valid_to = isset($dataDoc['valid_to']) ? $dataDoc['valid_to'] : 'Data de fim de validade não cadastrada';
        // $cnh = isset($dataDoc['cnh']) ? $dataDoc['cnh'] : 'CNH não cadastrada';
        // $rg = isset($dataDoc['rg']) ? $dataDoc['rg'] : 'RG não cadastrado';
        // $cpf = isset($dataDoc['cpf']) ? $dataDoc['cpf'] : 'CPF não cadastrado';
        // $workcard = isset($dataDoc['workcard']) ? $dataDoc['workcard'] : 'Carteira de trabalho não cadastrada';
        // $election = isset($dataDoc['election']) ? $dataDoc['election'] : 'Título de eleitor não cadastrado';
        // $passport = isset($dataDoc['passport']) ? $dataDoc['passport'] : 'Passaporte não cadastrado';  
        // $mother = isset($dataDoc['mother']) ? $dataDoc['mother'] : 'Nome da mãe não cadastrado';
        // $father = isset($dataDoc['father']) ? $dataDoc['father'] : 'Nome do pai não cadastrado';
        // $marital = isset($dataDoc['marital']) ? $dataDoc['marital'] : 'Estado civil não cadastrado';
        // $profession = isset($dataDoc['profession']) ? $dataDoc['profession'] : 'Profissão não cadastrada';
        // $gender = isset($dataDoc['gender']) ? $dataDoc['gender'] : 'Sexo não cadastrado';

        $user = User::findOrFail($id);

        $dataaddress = $request->only(['street', 'number', 'city', 'state', 'zip', 'country', 'cellphone', 'phone', 'whatsapp', 'telegram', 'facebook', 'instagram']);
        $user->address_data = json_encode($dataaddress);

        $datadocument = $request->only(['type', 'doc_number', 'issuer', 'birth', 'birthplace', 'nationality', 'issue_date', 'valid_to', 'cnh', 'rg', 'cpf', 'workcard', 'election', 'passport', 'mother', 'father', 'marital', 'profession', 'gender']);
        $user->document_data = json_encode($datadocument);

        $user->update($request->all());
        return redirect()->route('users_list.show')->with('success', 'Usuário atualizado com sucesso.');
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
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 0, // Nível padrão para novos usuários
            'address_data' => json_encode([]), // ou ajuste conforme necessário
            'document_data' => json_encode([]), // ou ajuste conforme necessário
        ]);
        return redirect()->route('users_list.show')->with('success', 'Usuário criado com sucesso.');
    }
}
