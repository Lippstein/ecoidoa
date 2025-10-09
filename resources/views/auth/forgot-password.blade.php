@extends("layouts.auth")
@section('title', 'Esqueci a Senha - Idoa')
@section('content')
<div class="container">
    <div class="bg-primary py-2 mb-4 rounded">
        <h4 class="text-white text-center">Esqueceu a senha?</h4>
    </div>
    <p>Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha.</p>
    <form method="POST" action="{{ route('password.email') }}" class="m-4">
        @csrf
        <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
           <button type="submit" class="btn btn-primary">Enviar link de redefinição</button>
        </div>
    </form>
</div>
@endsection