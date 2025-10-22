@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Nichos </h4>
        </div>
        @if($niches->isEmpty())
            <script>
                window.location.href = "{{ route('niches_create.show') }}";
            </script>
        @else
            <div class="flex items-center justify-center w-rounded">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('niches_create.show') }}" class="btn btn-success">Novo Nicho</a>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Niche</th>
                            <th></th>
                            <th>Habitat</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($niches as $niche)
                            <tr>
                                <td>{{ $niche->id }}</td>
                                <td>{{ $niche->niche }}</td>
                                <td>-></td>
                                <td>{{ $niche->habitat?->habitat ?? 'Não cadastrado' }}</td>
                                <td>{{ \Carbon\Carbon::parse($niche->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('niches_show.show', $niche->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                    <a href="{{ route('niches_edit.show', $niche->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('niches_destroy.show', $niche->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este nicho?');">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center w-rounded bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-2 rounded mb-4">
                    {{ $niches->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
@endsection