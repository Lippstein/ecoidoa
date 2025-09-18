<?php

namespace App\Http\Controllers\Nead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NeadController extends Controller
{
    /**
     * Exibe o formulário de nichos no Nead.
     */
    public function showNiches()
    {
        return view('nead.niches', [
            'title' => 'Área Restrita Nead'
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


