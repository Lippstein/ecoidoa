@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Termos</h4>
        </div>
        @if($tesauro->isEmpty())
        
            <script>
                window.location.href = "{{ route('term_create.show') }}";
            </script>
        @else
            <div class="flex items-end w-rounded">
                <div class="flex items justify-end gap-2 mb-3">
                    <a href="{{ route('term_create.show') }}" class="btn btn-success">Novo Termo</a>
                    <form method="POST" action="{{ route('tesauro_filter.show') }}">
                        @csrf
                        <input type="hidden" name="niche_id" id="niche_id_hidden" value="">
                        {{-- <div class="flex items-end mr-2"> --}}
                            <select class="form-select" name="niche_id" id="niche_id" required style="width: 20ch;">
                                <option value="0">Todos os nichos</option>
                                @foreach($niches as $niche)
                                    <option value="{{ $niche->id }}">{{ $niche->niche }}</option>
                                @endforeach
                            </select>
                        {{-- </div>                     --}}
                        <button type="submit" class="btn btn-secondary">Filtrar por Nicho</button>
                       {{-- <a href="{{ route('tesauro_filter.show') }}" class="btn btn-primary">Escolher Nicho</a> --}}
                    </form>
                </div>
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Termo</th>
                            <th>BT</th>
                            <th>NT</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tesauro as $term)
                            <tr>
                                <td>{{ $term->id }}</td>
                                <td>{{ $term->term }}</td>
                                <td>{{ $term->relationsNT->first()->id_term_bt ?? '-x-' }}</td>
 
                                @foreach($term->relationsBT as $relation)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $relation->id_term_nt ?? 'ID Termo?' }}  {{ $relation->termNT->term ?? 'Termo ?' }} n:{{ $relation->id_niche ?? 'Nicho ?' }} u:{{ $relation->id_user ?? 'Usuário ?' }}</td>
                                        <td>
                                    </tr>
                                @endforeach
                                
                                    {{-- <a href="{{ route('niches_show.show', $niche->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                    <a href="{{ route('niches_edit.show', $niche->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form method="POST" action="{{ route('niches_destroy.show', $niche->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este nicho?');">Excluir</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-center w-rounded bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-2 rounded mb-4">
                    {{ $tesauro->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
@endsection