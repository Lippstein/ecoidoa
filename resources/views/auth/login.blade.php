@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Senha:</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div>
            <button type="submit">Entrar</button>
        </div>

        <div style="margin-top:1em;">
            <a href="{{ route('register') }}">Nova conta</a> |
            <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        </div>
    </form>
</div>
@endsection