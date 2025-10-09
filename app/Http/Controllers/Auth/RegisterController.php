<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Exibe o formulário de registro.
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'title' => 'Área Restrita'
        ]);
    }

    /**
     * Processa o registro do usuário.
     */
    public function register(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
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

        event(new Registered($user));

        // Autentica o usuário após o registro
        Auth::login($user);
        // if (!session()->has('user_name')) {
        //     $userName = Auth::user()->name; // ou outro campo, como 'username'
        //     $userLevel = Auth::user()->level;
        //     session(['user_name' => $userName]);
        //     session(['user_level' => $userLevel]);
        // }


        // Redireciona para dashboard ou onde preferir
        return redirect()->route('dashboard')->with('status', 'Conta criada com sucesso!');
    }
}