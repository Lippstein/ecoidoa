@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Perfis do Usuário:<BR> {{ $user_id }} - {{ $name }} </h4>
        </div>
        @if($profiles->isEmpty())
            <script>
                Zerado - Novo Perfil;
                window.location.href = "{{ route('users_list.show', $user_id) }}";
            </script>
        @else
            <div class="flex items-center justify-center w-rounded">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('users_list.show') }}" class="btn btn-info">Voltar Lista Usuários</a>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>    </tr>
                            <th>Perfil (ID)</th>
                            <th>Habitat (ID)</th>
                            <th>Niche (ID)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->id }}</td>
                                <td>{{ optional($profile->habitat)->habitat }} ({{ $profile->habitat_id }})</td>
                                <td>{{ optional($profile->niche)->niche }} ({{ $profile->niche_id }})</td>
                                <td>
                                    <a href="{{ route('usersDataFlex_show.show', $profile->id) }}" class="btn btn-sm btn-info">Visualizar Perfil</a>
                                    <a href="{{ route('usersDataFlex_edit.show', $profile->id) }}" class="btn btn-sm btn-primary">Editar Perfil</a>
                                    <form method="POST" action="{{ route('usersDataFlex_destroy.show', [$profile->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este perfil?');">Excluir</button>
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
