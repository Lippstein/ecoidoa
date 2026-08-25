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
                    // dd($usersDataFlexList);
                    $habitat = $item->habitat->habitat;
                    $niche = $item->niche->niche;
                    $data = $item->niche->niche_data;
                    $profile = $item->user_profile;

                    if (is_string($data)) {
                        $decodedData = json_decode($data, true);
                        $data = (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) ? $decodedData : [];
                    }
                    if (is_string($profile)) {
                        $decodedProfile = json_decode($profile, true);
                        $profile = (json_last_error() === JSON_ERROR_NONE && is_array($decodedProfile)) ? $decodedProfile : [];
                    }
                    $iseNumber = $profile['iseNumber'] ?? null;

                    if (!is_array($data)) {
                        $data = [];
                    }

                    $values = array_values($data);
                    // $second = $values[1] ?? null;
                    // dd($item->user_profile, $iseNumber);
                @endphp
                
                <li>
                    {{-- ID: {{ $item->id }}<br>
                    Habitat: {{ $item->habitat->habitat }}<br>
                    Niche: {{ $item->niche->niche }}<br> --}}

                    {{-- <a href="{{ url('usersDataFlex/usersDataFlex_edit/' . $item->id) }}">
                        Editar
                    </a><br>
                    <a href="{{ url('usersDataFlex/usersDataFlex_acessar/' . $item->id) }}">
                        Acessar
                    </a> --}}
                    {{-- <br> --}}

                    @if ($item->niche_id == 1)
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <span>Núcleo de Educação a Distância (NEAD) do Instituto de Filosofia do Antropoceno (IdoA)</span>
                                <br><br>
                                <span class="badge bg-warning text-dark mb-3 px-3 py-2 text-uppercase fw-bold">Nunca é tarde para recomeçar</span>
                                <h1>Seja muito bem-vindo à nossa Escola!<BR></h1>
                                <h5>
                                    Núcleo de Educação de Jovens e Adultos e de Cultura Popular Darcy Vargas<br>
                                </h5>
                                <p class="lead mb-4">Aqui, respeitamos o seu tempo e valorizamos a sua história.<br> 
                                    Transforme a sua vida e conquiste novas oportunidades profissionais através dos estudos.</p>
                                <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Quero Estudar</a>
                                @if($iseNumber == '0')
                                    <a href="{{ route('users_edit_neejacpdv.show', [$item->user_id, $item->niche_id]) }}" class="btn btn-warning btn-lg fw-bold px-4 me-2">Quero finalizar minha Matrícula</a>
                                @endif
                                @if($iseNumber != '0')
                                    <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Realizar Avaliação</a>
                                @endif
                                <a href="#sobre" class="btn btn-warning btn-lg fw-bold px-4 me-2">Conhecer a Escola</a>
                                <p></p>
                            </div>
                        </div>
                    @endif
                    @if ($item->niche_id == 2)
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <span>Núcleo de Educação a Distância (NEAD) do Instituto de Filosofia do Antropoceno (IdoA)</span>
                                <br><br>
                                <span class="badge bg-warning text-dark mb-3 px-3 py-2 text-uppercase fw-bold">Nunca é tarde para recomeçar</span>
                                <h1>Seja muito bem-vindo à nossa Escola!<BR></h1>
                                <h5>
                                    Núcleo de Educação de Jovens e Adultos e de Cultura Popular Paulo Freire<br>
                                </h5>
                                <p class="lead mb-4">Aqui, respeitamos o seu tempo e valorizamos a sua história.<br> 
                                    Transforme a sua vida e conquiste novas oportunidades profissionais através dos estudos.</p>
                                <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Quero Estudar</a>
                                @if($iseNumber == '0')
                                    <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Quero finalizar minha Matrícula</a>
                                @endif
                                @if($iseNumber != '0')
                                    <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Realizar Avaliação</a>
                                @endif

                                <a href="#sobre" class="btn btn-warning btn-lg fw-bold px-4 me-2">Conhecer a Escola</a>
                                <p></p>
                            </div>
                        </div>
                    @endif

                    @if ($item->niche_id == 3)
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <span>Setor de Rateio Entre Amigos (RATEIO) do Instituto de Filosofia do Antropoceno (IdoA)</span>
                                <br><br>
                                <span class="badge bg-warning text-dark mb-3 px-3 py-2 text-uppercase fw-bold">Socialização e Lazer</span>
                                <h1>Seja muito bem-vindo ao Grupo UFCSPA-5!<BR></h1>
                                <h5>
                                    Grupo de Rateio Entre Amigos - UFCSPA-5<br>
                                </h5>
                                <p class="lead mb-4">Aqui, proporcionamos momentos de descontração, diversão, hobbies compartilhados e alívio do estresse do cotidiano.</p>
                                <a href="#mamtricula" class="btn btn-warning btn-lg fw-bold px-4 me-2">Acessar</a>
                                {{-- <a href="#sobre" class="btn btn-warning btn-lg fw-bold px-4 me-2">Conhecer o Grupo</a> --}}
                                <p></p>
                            </div>
                        </div>
                    @endif

                    {{-- {{ is_array($second) ? json_encode($second) : ($second ?? '') }}<br>

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
