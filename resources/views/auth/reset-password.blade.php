@extends("layouts.auth")
@section('title', 'Nova Senha - Idoa')
@section('content')
<div class="container">
    <div class="bg-primary py-2 mb-4 rounded">
        <h4 class="text-white text-center">Redefinir Senha</h4>
    </div>
    <form method="POST" action="{{ route('password.update') }}"  class="m-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $email ?? '') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova senha:</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirme a nova senha:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Redefinir senha</button>
        </div>
    </form>
</div>
@endsection