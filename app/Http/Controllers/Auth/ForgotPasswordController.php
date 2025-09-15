<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Exibe o formulário de solicitação de redefinição de senha.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password', [
            'title' => 'Área Restrita'
        ]);
    }

    /**
     * Envia o link de redefinição de senha para o e-mail do usuário.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Tenta enviar o link de redefinição
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {            
            return back()->with('status', 'Um link de redefinição foi enviado para seu e-mail.');
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}