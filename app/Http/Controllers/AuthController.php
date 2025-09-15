<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Container\Attributes\Auth;

class AuthController extends Controller
{
    //Login
    public function index()
    {
        // Carregar a VIEW
        return view('auth.login');
    }

    public function loginProcess(AuthLoginRequest $request)
    {
        dd($request);
        // Lógica de autenticação

    }
}

