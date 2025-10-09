@extends('layouts.app')
@section('content')
    {{-- <div class='dashboard-header'>
        <p>Usuário: {{ session('user_name') }}</p>
        <p>Seu ID de Usuário: {{ auth()->id() }}</p> 
    </div> --}}
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Seu Ecossistema </h4>
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
                        $vj = json_decode($data, JSON_UNESCAPED_UNICODE);
                        $values = array_values($vj);
                        $second = $values[1];
                    @endphp
                    
                    <li>
                        ID: {{ $item->id }}<br>
                        Habitat: {{ $item->habitat->habitat }}<br>
                        Niche: {{ $item->niche->niche }}<br>
                        {{ is_array($second) ? json_encode($second) : $second }}<br>

                        {{-- Dados: {{ $data }}<br> --}}
                        @if ($habitat === 'NEAD')
                            <a href="{{ route('login', $item->niche_id) }}">
                                {{ $habitat }}
                            </a>
                        @elseif ($habitat === 'RATEIO')
                            <a href="{{ route('login', $item->niche_id) }}">
                                {{ $habitat }}
                            </a>
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
