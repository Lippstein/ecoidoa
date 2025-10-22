<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

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
