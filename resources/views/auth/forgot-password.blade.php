@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>Esqueceu a senha?</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <button type="submit">Enviar link de redefinição</button>
        </div>
    </form>
</div>
@endsection