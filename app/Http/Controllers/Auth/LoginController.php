<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Área Restrita'
        ]);
    }

    /**
     * Processa a autenticação do usuário.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // Salva o campo 'name' do usuário autenticado na sessão
            // $request->session()->put('user_name', Auth::user()->name);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas não conferem.',
        ])->withInput($request->only('email'));
    }

    /**
     * Realiza o logout do usuário.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}


