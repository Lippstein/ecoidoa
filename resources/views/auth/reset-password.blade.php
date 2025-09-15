@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>Redefinir Senha</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email ?? '') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Nova senha:</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a nova senha:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit">Redefinir senha</button>
        </div>
    </form>
</div>
@endsection