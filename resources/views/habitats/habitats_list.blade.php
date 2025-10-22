@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Habitats </h4>
        </div>
        @if($habitats->isEmpty())
        dd($habitats);
            <script>
                window.location.href = "{{ route('habitats_create.show') }}";
            </script>
        @else
            <div class="flex items-center justify-center w-rounded">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('habitats_create.show') }}" class="btn btn-success">Novo Habitat</a>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>    </tr>
                            <th>ID</th>
                            <th>Habitat</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($habitats as $habitat)
                            <tr>
                                <td>{{ $habitat->id }}</td>
                                <td>{{ $habitat->habitat }}</td>
                                <td>{{ \Carbon\Carbon::parse($habitat->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('habitats_show.show', $habitat->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                    <a href="{{ route('habitats_edit.show', $habitat->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('habitats_destroy.show', [$habitat->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este habitat?');">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center w-rounded bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-2 rounded mb-4">
                    {{ $habitats->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
@endsection