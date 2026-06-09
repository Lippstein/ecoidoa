@extends('layouts.app')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Meu Ecossistema </h4>
    </div>
    @if($usersDataFlexList->isEmpty())
        {{-- redirect to habitats_niches --}}
        <script>
            window.location.href = "{{ route('habitats_niches.show') }}";
        </script>
    @else
        <ul>
            @foreach($usersDataFlexList as $item)
                @php
                //  dd($usersDataFlexList);
                    $habitat = $item->habitat->habitat;
                    $niche = $item->niche->niche;
                    $data = $item->niche->niche_data;

                    if (is_string($data)) {
                        $decodedData = json_decode($data, true);
                        $data = (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) ? $decodedData : [];
                    }

                    if (!is_array($data)) {
                        $data = [];
                    }

                    $values = array_values($data);
                    $second = $values[1] ?? null;
                @endphp
                
                <li>
                    ID: {{ $item->id }}<br>
                    Habitat: {{ $item->habitat->habitat }}<br>
                    Niche: {{ $item->niche->niche }}<br>
                    <a href="{{ url('usersDataFlex/usersDataFlex_edit/' . $item->id) }}">
                        Editar
                    </a><br>

                    {{ is_array($second) ? json_encode($second) : ($second ?? '') }}<br>

                    {{-- Dados: {{ $data }}<br> --}}
                    @if ($habitat === 'NEAD')
                        {{-- <a href="{{ route('resultados.show', $item->niche_id) }}">
                            {{ $habitat }}
                        </a> --}}
                    @elseif ($habitat === 'RATEIO')
                        {{-- <a href="{{ route('resultados.show', $item->niche_id) }}">
                            {{ 'Clique aqui para acessar ' . $habitat . ' -> ' . $item->niche->niche }}
                        </a> --}}
                    @elseif ($habitat === 'OUTROSISTEMA')
                        {{-- <a href="{{ route('outrosistema.show', $item->niche_id) }}">
                            {{ $habitat }}
                        </a> --}}
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
