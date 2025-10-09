@extends("layouts.app")
@section('title', 'Nova Conta - Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Usuário</h4>
    </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('users_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>

    <form method="POST" action="{{ route('users_create.store') }}"  class="m-4">
        @csrf
        <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirme a senha:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">cadastrar</button>
        </div>
    </form>
</div>
@endsection