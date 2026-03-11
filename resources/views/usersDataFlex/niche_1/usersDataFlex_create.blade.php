@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users DataFlex (perfil)</h1>
        <p>CREATE</p>

        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Usuários </h4>
        </div>
        @if($profiles->isEmpty())
            <script>
                window.location.href = "{{ route('users_create.show') }}";
            </script>
        @else
            <div class="flex items-center justify-center w-rounded">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('usersDataFlex_create.show') }}" class="btn btn-success">Novo Perfil</a>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>    </tr>
                            <th>ID</th>
                            <th>Habitat_ID</th>
                            <th>Niche_ID</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->id }}</td>
                                <td>{{ $profile->habitat_id }}</td>
                                <td>{{ $profile->niche_id }}</td>
                                <td>
                                    <a href="{{ route('usersDataFlex_show.show', $profile->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                    <a href="{{ route('usersDataFlex_edit.show', $profile->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('usersDataFlex_destroy.show', [$profile->id]) }}" style="display:inline;">
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
                    {{ $profiles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection
