@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Usuários </h4>
        </div>
        @if($users->isEmpty())
            <script>
                window.location.href = "{{ route('users_create.show') }}";
            </script>
        @else
            <div class="flex items-center justify-center w-rounded">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('users_create.show') }}" class="btn btn-success">Novo Usuário</a>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>    </tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users_show.show', $user->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                    <a href="{{ route('users_edit.show', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('users_destroy.show', [$user->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center w-rounded bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-2 rounded mb-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
@endsection


