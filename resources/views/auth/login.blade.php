@extends("layouts.auth")
@section('title', 'Login - Idoa')
@section("content")
<div class="container">
    <div class="bg-primary py-2 mb-4 rounded">
        <h4 class="text-white text-center">Login</h4>
    </div>
    <form method="POST" action="{{ route('login') }}" class="m-4">
        @csrf
        <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
            <input
                type="checkbox"
                class="form-check-input"
                id="remember"
                name="remember"
                value="1"
                {{ old('remember') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="remember">Lembrar de mim</label>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
        <div class="form-text">
            <a href="{{ route('register') }}">Nova conta!</a> |
            <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        </div>
    </form>
</div>
@endsection