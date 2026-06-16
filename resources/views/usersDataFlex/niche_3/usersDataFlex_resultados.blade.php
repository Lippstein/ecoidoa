@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Perfil do Usuário - Nicho {{ $niche_id }}</h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            @if (Auth::user()->level >= 5)
                <button type="button" class="btn btn-warning" onclick="toggleReadonly()">
                    Habilitar Edição
                </button>
                <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info">Lista de Perfis</a>
                <a href="{{ route('usersDataFlex_edit.show', ['id' => $userDataFlex->id]) }}" class="btn btn-info">Editar Perfil</a>
            @else
                <a href="{{ route('usersDataFlex_edit.show', ['id' => $userDataFlex->id]) }}" class="btn btn-info">Editar Perfil</a>
            @endif
        </div>
        <div class="row mb-2">
            <div>
              Perfil (ID): <strong> {{ $userDataFlex->id }} </strong> - Habitat_ID: <strong> {{ $userDataFlex->habitat_id }} </strong> - Niche_ID: <strong> {{ $userDataFlex->niche_id }} </strong>
            </div>        
            <div>
                Nome do Usuário: <strong>{{ $user->name }}</strong> - User_ID: <strong> {{ $userDataFlex->user_id }} </strong>
            </div>
            <div>
                Data de Cadastro:<strong>{{ \Carbon\Carbon::parse($userDataFlex->created_at)->format('d/m/Y H:i:s') }}</strong>
                - Data de Atualização:<strong>{{ \Carbon\Carbon::parse($userDataFlex->updated_at)->format('d/m/Y H:i:s') }}</strong>
            </div>
        </div>

        <div class="accordion accordion-flush" id="accordionFlushUserResultados">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <strong>Participou dos Seguintes Rateios</strong>
            </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushUserResultados">
                <div class="accordion-body">
                    @php
                        $formatMoneyRateio = static fn ($value): string => 'R$ ' . number_format((float) $value, 2, ',', '.');
                        // $userDataFlex = UsersDataFlex::findOrFail($id);
                        // $user = \App\Models\User::findOrFail($userDataFlex->user_id);
                        $niche = \App\Models\Niche::findOrFail($userDataFlex->niche_id);

                        $userRateiosByNiche = [];
                        $terms = \App\Models\Term::select('id', 'id_niche', 'term', 'definition', 'created_at', 'term_data')
                            ->whereNotNull('term_data')
                            ->get();

                        foreach ($terms as $term) {
                            $termData = $term->term_data;
                            if (is_string($termData)) {
                                $decoded = json_decode($termData, true);
                                $termData = is_array($decoded) ? $decoded : [];
                            }

                            if (!is_array($termData)) {
                                continue;
                            }

                            $rateios = $termData['rateios'] ?? [];
                            if (!is_array($rateios)) {
                                continue;
                            }

                            foreach ($rateios as $rateioIndex => $rateio) {
                                if (!is_array($rateio)) {
                                    continue;
                                }

                                $participants = $rateio['participants'] ?? [];
                                if (!is_array($participants)) {
                                    continue;
                                }

                                foreach ($participants as $participant) {
                                    if (!is_array($participant)) {
                                        continue;
                                    }

                                    if ((int) ($participant['user_id'] ?? 0) !== (int) $userDataFlex->user_id) {
                                        continue;
                                    }

                                    $lotteryNumbersUser = $participant['lotteryNumbersUser'] ?? ($participant['lotteryNumbers'] ?? []);
                                    if (is_string($lotteryNumbersUser)) {
                                        $lotteryNumbersUser = array_map('trim', explode(',', $lotteryNumbersUser));
                                    }

                                    $lotteryNumbersUser = array_values(array_filter(
                                        array_map('intval', is_array($lotteryNumbersUser) ? $lotteryNumbersUser : []),
                                        fn ($number) => $number >= 1 && $number <= 80
                                    ));
                                    sort($lotteryNumbersUser);

                                    $lotteryNumbersRateio = array_values(array_map(
                                        'intval',
                                        is_array($rateio['lotteryNumbers'] ?? null) ? $rateio['lotteryNumbers'] : []
                                    ));
                                    sort($lotteryNumbersRateio);

                                    $hitsCount = count(array_intersect($lotteryNumbersUser, $lotteryNumbersRateio));

                                    $userRateiosByNiche[$term->id_niche][] = [
                                        'term_id' => $term->id,
                                        'term' => $term->term,
                                        'definition' => $term->definition,
                                        'term_created_at' => $term->created_at,
                                        'rateio_index' => $rateioIndex,
                                        'rateio' => $rateio,
                                        'participant' => $participant,
                                        'lotteryNumbersUser' => $lotteryNumbersUser,
                                        'lotteryNumbersRateio' => $lotteryNumbersRateio,
                                        'hitsCount' => $hitsCount,
                                    ];
                                }
                            }
                        }

                        if (!empty($userRateiosByNiche)) {
                            ksort($userRateiosByNiche);
                            foreach ($userRateiosByNiche as &$rateiosList) {
                                usort($rateiosList, function ($a, $b) {
                                    $dateA = (string) ($a['rateio']['concourseCEFDate'] ?? '');
                                    $dateB = (string) ($b['rateio']['concourseCEFDate'] ?? '');
                                    if ($dateA !== $dateB) {
                                        return strcmp($dateB, $dateA);
                                    }

                                    $numberA = (int) ($a['rateio']['concourseCEFNumber'] ?? 0);
                                    $numberB = (int) ($b['rateio']['concourseCEFNumber'] ?? 0);
                                    return $numberB <=> $numberA;
                                });
                            }
                            unset($rateiosList);
                        }


                    @endphp

                    @if (empty($userRateiosByNiche))
                        <div class="alert alert-secondary mb-0">
                            Este usuário ainda não aparece como participante em nenhum rateio.
                        </div>
                    @else
                        @foreach ($userRateiosByNiche as $nicheIdRateio => $rateiosList)
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong>Nicho {{ $nicheIdRateio }}</strong>
                                    <span class="text-muted">- {{ count($rateiosList) }} rateio(s)</span>
                                </div>
                                <div class="card-body">
                                    @foreach ($rateiosList as $rateioEntry)
                                        @php
                                            $rateio = $rateioEntry['rateio'] ?? [];
                                            $participant = $rateioEntry['participant'] ?? [];
                                            $numbersUser = $rateioEntry['lotteryNumbersUser'] ?? [];
                                            $numbersRateio = $rateioEntry['lotteryNumbersRateio'] ?? [];
                                            $numbersRateioSet = array_flip($numbersRateio);
                                            $numbersUserSet = array_flip($numbersUser);
                                        @endphp

                                        <div class="border rounded p-3 mb-3">
                                            <div class="d-flex flex-wrap gap-3 mb-2">
                                                <div><strong>Rateio:</strong> {{ $rateio['concourseCEFNumber'] ?? '-' }}</div>
                                                <div><strong>Data:</strong> {{ \Carbon\Carbon::parse($rateio['concourseCEFDate'] ?? null)->format('d/m/Y') ?? '-' }}</div>
                                                <div><strong>Termo:</strong> {{ $rateioEntry['term'] ?? '-' }} (ID {{ $rateioEntry['term_id'] ?? '-' }})</div>
                                                <div><strong>Acertos:</strong> {{ $rateioEntry['hitsCount'] ?? 0 }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 mb-2">
                                                    <strong>Números do usuário (em destaque quando sorteado):</strong><br>
                                                    @forelse ($numbersUser as $number)
                                                        <span class="badge number-badge {{ isset($numbersRateioSet[$number]) ? 'bg-success' : 'bg-secondary' }}">{{ $number }}</span>
                                                    @empty
                                                        <span class="text-muted">Sem números informados.</span>
                                                    @endforelse
                                                </div>
                                                <div class="col-12 col-md-6 mb-2">
                                                    <strong>Números do rateio:</strong><br>
                                                    @forelse ($numbersRateio as $number)
                                                        <span class="badge number-badge {{ isset($numbersUserSet[$number]) ? 'bg-success' : 'bg-dark' }}">{{ $number }}</span>
                                                    @empty
                                                        <span class="text-muted">Sem números sorteados.</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>Contribuição:</strong> {{ $formatMoneyRateio($participant['contribution'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Total Contribuições:</strong> {{ $formatMoneyRateio($rateio['totalRateio'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Total Premio:</strong> {{ $formatMoneyRateio($rateio['totalPrize'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>Acum. Próximo:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Next'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Acum. Final 5:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Final5'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Acum. Especial:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Special'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>5 acertos:</strong> {{ count($rateio['5_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['5_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 5 acertos:</strong> {{ $formatMoneyRateio(count($rateio['5_hits'] ?? []) > 0 ? $rateio['value_5_hits']/count($rateio['5_hits']) : $rateio['value_5_hits'] ?? 0) }} </div>
                                                <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_5_hits'] ?? 0) . ')' }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>4 acertos:</strong> {{ count($rateio['4_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['4_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 4 acertos:</strong> {{ $formatMoneyRateio(count($rateio['4_hits'] ?? []) > 0 ? $rateio['value_4_hits']/count($rateio['4_hits']) : $rateio['value_4_hits'] ?? 0) }} </div>
                                                <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_4_hits'] ?? 0) . ')' }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>3 acertos:</strong> {{ count($rateio['3_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['3_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 3 acertos:</strong> {{ $formatMoneyRateio(count($rateio['3_hits'] ?? []) > 0 ? $rateio['value_3_hits']/count($rateio['3_hits']) : $rateio['value_3_hits'] ?? 0) }} </div>
                                                <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_3_hits'] ?? 0) . ')' }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>2 acertos:</strong> {{ count($rateio['2_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['2_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 2 acertos:</strong> {{ $formatMoneyRateio(count($rateio['2_hits'] ?? []) > 0 ? $rateio['value_2_hits']/count($rateio['2_hits']) : $rateio['value_2_hits'] ?? 0) }} </div>
                                                <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_2_hits'] ?? 0) . ')' }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>1 acertos:</strong> {{ count($rateio['1_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['1_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 1 acertos:</strong> {{ $formatMoneyRateio(count($rateio['1_hits'] ?? []) > 0 ? $rateio['value_1_hits']/count($rateio['1_hits']) : $rateio['value_1_hits'] ?? 0) }} </div>
                                                <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_1_hits'] ?? 0) . ')' }}</div>
                                            </div>

                                            {{-- <details class="mt-3">
                                                <summary><strong>Ver todas as informações do rateio (JSON completo)</strong></summary>
                                                <pre class="rateio-json mb-0 mt-2">{{ json_encode($rateio, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
                                            </details> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <strong>Rateios com 1 ou mais acertos</strong>
            </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushUserResultados">
                <div class="accordion-body">
                    @php
                        $formatMoneyRateio = static fn ($value): string => 'R$ ' . number_format((float) $value, 2, ',', '.');
                        // $userDataFlex = UsersDataFlex::findOrFail($id);
                        // $user = \App\Models\User::findOrFail($userDataFlex->user_id);
                        $niche = \App\Models\Niche::findOrFail($userDataFlex->niche_id);

                        $userRateiosByNiche = [];
                        $terms = \App\Models\Term::select('id', 'id_niche', 'term', 'definition', 'created_at', 'term_data')
                            ->whereNotNull('term_data')
                            ->get();

                        foreach ($terms as $term) {
                            $termData = $term->term_data;
                            if (is_string($termData)) {
                                $decoded = json_decode($termData, true);
                                $termData = is_array($decoded) ? $decoded : [];
                            }

                            if (!is_array($termData)) {
                                continue;
                            }

                            $rateios = $termData['rateios'] ?? [];
                            if (!is_array($rateios)) {
                                continue;
                            }

                            foreach ($rateios as $rateioIndex => $rateio) {
                                if (!is_array($rateio)) {
                                    continue;
                                }

                                $participants = $rateio['participants'] ?? [];
                                if (!is_array($participants)) {
                                    continue;
                                }

                                foreach ($participants as $participant) {
                                    if (!is_array($participant)) {
                                        continue;
                                    }

                                    if ((int) ($participant['user_id'] ?? 0) !== (int) $userDataFlex->user_id) {
                                        continue;
                                    }

                                    $lotteryNumbersUser = $participant['lotteryNumbersUser'] ?? ($participant['lotteryNumbers'] ?? []);
                                    if (is_string($lotteryNumbersUser)) {
                                        $lotteryNumbersUser = array_map('trim', explode(',', $lotteryNumbersUser));
                                    }

                                    $lotteryNumbersUser = array_values(array_filter(
                                        array_map('intval', is_array($lotteryNumbersUser) ? $lotteryNumbersUser : []),
                                        fn ($number) => $number >= 1 && $number <= 80
                                    ));
                                    sort($lotteryNumbersUser);

                                    $lotteryNumbersRateio = array_values(array_map(
                                        'intval',
                                        is_array($rateio['lotteryNumbers'] ?? null) ? $rateio['lotteryNumbers'] : []
                                    ));
                                    sort($lotteryNumbersRateio);

                                    $hitsCount = count(array_intersect($lotteryNumbersUser, $lotteryNumbersRateio));

                                    if($hitsCount>0){
                                        $userRateiosByNiche[$term->id_niche][] = [
                                            'term_id' => $term->id,
                                            'term' => $term->term,
                                            'definition' => $term->definition,
                                            'term_created_at' => $term->created_at,
                                            'rateio_index' => $rateioIndex,
                                            'rateio' => $rateio,
                                            'participant' => $participant,
                                            'lotteryNumbersUser' => $lotteryNumbersUser,
                                            'lotteryNumbersRateio' => $lotteryNumbersRateio,
                                            'hitsCount' => $hitsCount,
                                        ];
                                    }
                                }
                            }
                        }

                        if (!empty($userRateiosByNiche)) {
                            ksort($userRateiosByNiche);
                            foreach ($userRateiosByNiche as &$rateiosList) {
                                usort($rateiosList, function ($a, $b) {
                                    $dateA = (string) ($a['rateio']['concourseCEFDate'] ?? '');
                                    $dateB = (string) ($b['rateio']['concourseCEFDate'] ?? '');
                                    if ($dateA !== $dateB) {
                                        return strcmp($dateB, $dateA);
                                    }

                                    $numberA = (int) ($a['rateio']['concourseCEFNumber'] ?? 0);
                                    $numberB = (int) ($b['rateio']['concourseCEFNumber'] ?? 0);
                                    return $numberB <=> $numberA;
                                });
                            }
                            unset($rateiosList);
                        }


                    @endphp

                    @if (empty($userRateiosByNiche))
                        <div class="alert alert-secondary mb-0">
                            Este usuário ainda não aparece como participante em nenhum rateio.
                        </div>
                    @else
                        @foreach ($userRateiosByNiche as $nicheIdRateio => $rateiosList)
                            {{-- @if (collect($rateiosList)->contains(fn ($entry) => (($entry['hitsCount'] ?? 0) > 0))) --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <strong>Nicho {{ $nicheIdRateio }}</strong>
                                        <span class="text-muted">- {{ count($rateiosList) }} rateio(s)</span>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($rateiosList as $rateioEntry)
                                            @php
                                                $rateio = $rateioEntry['rateio'] ?? [];
                                                $participant = $rateioEntry['participant'] ?? [];
                                                $numbersUser = $rateioEntry['lotteryNumbersUser'] ?? [];
                                                $numbersRateio = $rateioEntry['lotteryNumbersRateio'] ?? [];
                                                $numbersRateioSet = array_flip($numbersRateio);
                                                $numbersUserSet = array_flip($numbersUser);
                                            @endphp

                                            <div class="border rounded p-3 mb-3">
                                                <div class="d-flex flex-wrap gap-3 mb-2">
                                                    <div><strong>Rateio:</strong> {{ $rateio['concourseCEFNumber'] ?? '-' }}</div>
                                                    <div><strong>Data:</strong> {{ \Carbon\Carbon::parse($rateio['concourseCEFDate'] ?? null)->format('d/m/Y') ?? '-' }}</div>
                                                    <div><strong>Termo:</strong> {{ $rateioEntry['term'] ?? '-' }} (ID {{ $rateioEntry['term_id'] ?? '-' }})</div>
                                                    <div><strong>Acertos:</strong> {{ $rateioEntry['hitsCount'] ?? 0 }}</div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6 mb-2">
                                                        <strong>Números do usuário (em destaque quando sorteado):</strong><br>
                                                        @forelse ($numbersUser as $number)
                                                            <span class="badge number-badge {{ isset($numbersRateioSet[$number]) ? 'bg-success' : 'bg-secondary' }}">{{ $number }}</span>
                                                        @empty
                                                            <span class="text-muted">Sem números informados.</span>
                                                        @endforelse
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-2">
                                                        <strong>Números do rateio:</strong><br>
                                                        @forelse ($numbersRateio as $number)
                                                            <span class="badge number-badge {{ isset($numbersUserSet[$number]) ? 'bg-success' : 'bg-dark' }}">{{ $number }}</span>
                                                        @empty
                                                            <span class="text-muted">Sem números sorteados.</span>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>Contribuição:</strong> {{ $formatMoneyRateio($participant['contribution'] ?? 0) }}</div>
                                                    <div class="col-md-3"><strong>Total Contribuições:</strong> {{ $formatMoneyRateio($rateio['totalRateio'] ?? 0) }}</div>
                                                    <div class="col-md-3"><strong>Total Premio:</strong> {{ $formatMoneyRateio($rateio['totalPrize'] ?? 0) }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>Acum. Próximo:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Next'] ?? 0) }}</div>
                                                    <div class="col-md-3"><strong>Acum. Final 5:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Final5'] ?? 0) }}</div>
                                                    <div class="col-md-3"><strong>Acum. Especial:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Special'] ?? 0) }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>5 acertos:</strong> {{ count($rateio['5_hits'] ?? []) }} Ganhador(es)</div>
                                                    <div class="col-md-3"><strong>{{ count($rateio['5_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 5 acertos:</strong> {{ $formatMoneyRateio(count($rateio['5_hits'] ?? []) > 0 ? $rateio['value_5_hits']/count($rateio['5_hits']) : $rateio['value_5_hits'] ?? 0) }} </div>
                                                    <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_5_hits'] ?? 0) . ')' }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>4 acertos:</strong> {{ count($rateio['4_hits'] ?? []) }} Ganhador(es)</div>
                                                    <div class="col-md-3"><strong>{{ count($rateio['4_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 4 acertos:</strong> {{ $formatMoneyRateio(count($rateio['4_hits'] ?? []) > 0 ? $rateio['value_4_hits']/count($rateio['4_hits']) : $rateio['value_4_hits'] ?? 0) }} </div>
                                                    <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_4_hits'] ?? 0) . ')' }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>3 acertos:</strong> {{ count($rateio['3_hits'] ?? []) }} Ganhador(es)</div>
                                                    <div class="col-md-3"><strong>{{ count($rateio['3_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 3 acertos:</strong> {{ $formatMoneyRateio(count($rateio['3_hits'] ?? []) > 0 ? $rateio['value_3_hits']/count($rateio['3_hits']) : $rateio['value_3_hits'] ?? 0) }} </div>
                                                    <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_3_hits'] ?? 0) . ')' }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>2 acertos:</strong> {{ count($rateio['2_hits'] ?? []) }} Ganhador(es)</div>
                                                    <div class="col-md-3"><strong>{{ count($rateio['2_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 2 acertos:</strong> {{ $formatMoneyRateio(count($rateio['2_hits'] ?? []) > 0 ? $rateio['value_2_hits']/count($rateio['2_hits']) : $rateio['value_2_hits'] ?? 0) }} </div>
                                                    <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_2_hits'] ?? 0) . ')' }}</div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-3"><strong>1 acertos:</strong> {{ count($rateio['1_hits'] ?? []) }} Ganhador(es)</div>
                                                    <div class="col-md-3"><strong>{{ count($rateio['1_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 1 acertos:</strong> {{ $formatMoneyRateio(count($rateio['1_hits'] ?? []) > 0 ? $rateio['value_1_hits']/count($rateio['1_hits']) : $rateio['value_1_hits'] ?? 0) }} </div>
                                                    <div class="col-md-3">{{ 'Total: (' . $formatMoneyRateio($rateio['value_1_hits'] ?? 0) . ')' }}</div>
                                                </div>

                                                {{-- <details class="mt-3">
                                                    <summary><strong>Ver todas as informações do rateio (JSON completo)</strong></summary>
                                                    <pre class="rateio-json mb-0 mt-2">{{ json_encode($rateio, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
                                                </details> --}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            {{-- @endif --}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


 
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTree" aria-expanded="false" aria-controls="flush-collapseTree">
                <strong>Lista de todos os Rateios</strong>
            </button>
            </h2>
            <div id="flush-collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushUserResultados">
                <div class="accordion-body">
                    @php
                        $rateiosStr = "ufcspa5_";
                        $rateiosNicho = \App\Models\Term::where('term', 'like', '%' . $rateiosStr . '%')
                            ->where('id_niche', $niche_id)
                            ->orderBy('id', 'desc')
                            ->get();
                    @endphp

                    @if ($rateiosNicho->isEmpty())
                        <div class="alert alert-secondary mb-0">
                             Nenhum rateio.
                        </div>
                    @else
                        @foreach ($rateiosNicho as $rateioTerm)
                            @php
                                $termData = $rateioTerm->term_data;
                                if (is_string($termData)) {
                                    $decodedTermData = json_decode($termData, true);
                                    $termData = is_array($decodedTermData) ? $decodedTermData : [];
                                }

                                if (!is_array($termData)) {
                                    $termData = [];
                                }

                                $rateios = $termData['rateios'] ?? [];
                                $rateioJson = (is_array($rateios) && !empty($rateios))
                                    ? ($rateios[0] ?? [])
                                    : [];
                            @endphp

                            <pre class="rateio-json mb-0 mt-2">{{ json_encode($rateioJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>






        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRules" aria-expanded="false" aria-controls="flush-collapseRules">
                <strong>Regulamentos do Nicho {{ $niche_id }}</strong>
            </button>
            </h2>
            <div id="flush-collapseRules" class="accordion-collapse collapse" data-bs-parent="#accordionFlushUserResultados">
                <div class="accordion-body">
                    @php
                        $nicheRules = \App\Models\Niche::where('id', $niche_id)
                            ->get();
                        $data = $nicheRules->first()->niche_data ?? [];
                        if (is_string($data)) {
                            try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
                        }
                    @endphp

                    @if ($nicheRules->isEmpty())
                        <div class="alert alert-secondary mb-0">
                             Nenhum regulamento encontrado para o nicho {{ $niche_id }}.
                        </div>
                    @else
                        @php
                            if (is_string($data)) {
                                $decodedNicheData = json_decode($data, true);
                                $data = is_array($decodedNicheData) ? $decodedNicheData : [];
                            }

                            if (!is_array($data)) {
                                $data = [];
                            }

                            $rules = isset($data['rules']) ? $data['rules'] : [];
                            $formatRule = static fn ($value): string => nl2br(e((string) $value));

                            $rule0 = $formatRule($rules['rule0'] ?? '');
                            $rule1 = $formatRule($rules['rule1'] ?? '');
                            $rule2 = $formatRule($rules['rule2'] ?? '');
                            $rule3 = $formatRule($rules['rule3'] ?? '');
                            $rule4 = $formatRule($rules['rule4'] ?? '');
                            $rule5 = $formatRule($rules['rule5'] ?? '');
                            $rule6 = $formatRule($rules['rule6'] ?? '');
                            $rule7 = $formatRule($rules['rule7'] ?? '');
                            $rule8 = $formatRule($rules['rule8'] ?? '');
                            $rule9 = $formatRule($rules['rule9'] ?? '');





                            // $rules = [];
                            // for ($i = 0; $i <= 9; $i++) {
                            //     $key = 'rule' . $i;
                            //     $rules[$key] = $data[$key] ?? null;
                            // }
                            $rulesJson = $rules;
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div><strong>01:</strong><br> {!! $rule0 !!}</div>
                                <div><strong>02:</strong><br> {!! $rule1 !!}</div>
                                <div><strong>03:</strong><br> {!! $rule2 !!}</div>
                                <div><strong>04:</strong><br> {!! $rule3 !!}</div>
                                <div><strong>05:</strong><br> {!! $rule4 !!}</div>
                                <div><strong>06:</strong><br> {!! $rule5 !!}</div>
                                <div><strong>07:</strong><br> {!! $rule6 !!}</div>
                                <div><strong>08:</strong><br> {!! $rule7 !!}</div>
                                <div><strong>09:</strong><br> {!! $rule8 !!}</div>
                                <div><strong>10:</strong><br> {!! $rule9 !!}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="true" aria-controls="flush-collapseFour">
                <strong>Simulação dos Próximos Rateios</strong>
            </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushUserResultados">
                <div class="accordion-body">
                    @php
                        $rateiosStr = "ufcspa5_";
                        $rateiosNicho = \App\Models\Term::where('term', 'like', '%' . $rateiosStr . '%')
                            ->where('id_niche', $niche_id)
                            ->orderBy('id', 'desc')
                            ->get();
                            
                    @endphp

                    @if ($rateiosNicho->isEmpty())
                        <div class="alert alert-secondary mb-0">
                             Nenhum rateio.
                        </div>
                    @else
                        @foreach ($rateiosNicho as $rateioTerm)
                        
                            @php
                                $termData = $rateioTerm->term_data;
                                if (is_string($termData)) {
                                    $decodedTermData = json_decode($termData, true);
                                    $termData = is_array($decodedTermData) ? $decodedTermData : [];
                                }
                                if (!is_array($termData)) {
                                    $termData = [];
                                }

                                $rateioJson = (is_array($termData['rateios'] ?? null) && !empty($termData['rateios']))
                                    ? ($termData['rateios'][0] ?? [])
                                    : [];

                                $availableBalanceNext = (float) ($rateioJson['availableBalance_Next'] ?? 0);
                                $availableBalanceFinal5 = (float) ($rateioJson['availableBalance_Final5'] ?? 0);
                                $availableBalanceSpecial = (float) ($rateioJson['availableBalance_Special'] ?? 0);
                            @endphp
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong>Nicho {{ $rateioTerm->id_niche }}</strong>
                                    <span class="text-muted">- Projeção próximos rateios</span>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-md-3"><strong>Acumulado Próximo Rateio:</strong></div>
                                            <div class="col-md-3">{{ $formatMoneyRateio($availableBalanceNext ?? 0) }}</div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-3"><strong>Acumulado Próximo Rateio Final 5:</strong></div>
                                            <div class="col-md-3">{{ $formatMoneyRateio(($availableBalanceNext ?? 0) + ($availableBalanceFinal5 ?? 0)) }}</div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-3"><strong>Acumulado Próximo Rateio Especial:</strong></div>
                                            <div class="col-md-3">{{ $formatMoneyRateio(($availableBalanceNext ?? 0)+($availableBalanceSpecial ?? 0)) }}</div>
                                        </div>
                                    </div>
                                    @break {{-- Para mostrar apenas o rateio mais recente por termo, descomente este break --}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


    </div>










    <style>
    .number-grid {
        display: grid;
        grid-template-columns: repeat(10, minmax(0, 1fr));
        column-gap: 6px;
        row-gap: 6px;
    }

    .number-picker {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .number-badge {
        font-size: 0.85rem;
        margin-right: 4px;
        margin-bottom: 4px;
        min-width: 36px;
    }

    .rateio-json {
        max-height: 240px;
        overflow: auto;
        padding: 10px;
        border-radius: 8px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        font-size: 0.82rem;
    }
    </style>

    <script>
    function toggleReadonly() {
        const readonlyFields = document.querySelectorAll('.readonly-field');
        readonlyFields.forEach(field => {
            if (field.hasAttribute('readonly')) {
                field.removeAttribute('readonly');
                field.classList.add('border-success');
            } else {
                field.setAttribute('readonly', true);
                field.classList.remove('border-success');
            }
        });

        const lotteryFields = document.querySelectorAll('[id^="lotteryNumbersUser_"]');
        const isReadonly = lotteryFields.length > 0 ? lotteryFields[0].hasAttribute('readonly') : true;
        document.querySelectorAll('.number-picker').forEach(button => {
            button.disabled = isReadonly;
        });
    }

    (function () {
        const profileForm = document.querySelector('form[action*="usersDataFlex_update"]');
        const moneyFieldIds = ['maintenance', 'availableBalance', 'totalCredits', 'totalDebts'];

        function parseCurrencyToNumeric(value) {
            const raw = String(value ?? '')
                .replace(/\s+/g, '')
                .replace('R$', '');

            const hasComma = raw.includes(',');
            const hasDot = raw.includes('.');
            let cleaned = raw;

            // Aceita "1234.56", "1.234,56" e "1234,56".
            if (hasComma && hasDot) {
                const lastComma = raw.lastIndexOf(',');
                const lastDot = raw.lastIndexOf('.');
                if (lastComma > lastDot) {
                    cleaned = raw.replace(/\./g, '').replace(',', '.');
                } else {
                    cleaned = raw.replace(/,/g, '');
                }
            } else if (hasComma) {
                cleaned = raw.replace(/\./g, '').replace(',', '.');
            } else {
                cleaned = raw.replace(/,/g, '');
            }

            const number = parseFloat(cleaned);
            return Number.isFinite(number) ? number.toFixed(2) : '0.00';
        }

        function formatCurrencyBRL(value) {
            const numeric = parseCurrencyToNumeric(value);
            const [intPart, decimalPart] = numeric.split('.');
            const intWithThousands = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return `R$ ${intWithThousands},${decimalPart}`;
        }

        moneyFieldIds.forEach(id => {
            const field = document.getElementById(id);
            if (!field) {
                return;
            }

            field.value = formatCurrencyBRL(field.value);

            field.addEventListener('focus', () => {
                if (field.hasAttribute('readonly')) {
                    return;
                }
                field.value = parseCurrencyToNumeric(field.value).replace('.', ',');
            });

            field.addEventListener('blur', () => {
                field.value = formatCurrencyBRL(field.value);
            });
        });

        if (profileForm) {
            profileForm.addEventListener('submit', () => {
                moneyFieldIds.forEach(id => {
                    const field = document.getElementById(id);
                    if (!field) {
                        return;
                    }
                    field.value = parseCurrencyToNumeric(field.value);
                });
            });
        }

        const numberButtons = Array.from(document.querySelectorAll('.number-picker'));
        const lotteryFields = Array.from(document.querySelectorAll('[id^="lotteryNumbersUser_"]'));
        const counter = document.getElementById('lotteryNumbersCounter');
        const limitWarning = document.getElementById('lotteryNumbersLimitWarning');
        let warningTimeoutId = null;

        function getSelectedNumbers() {
            return lotteryFields
                .map(field => parseInt(field.value, 10))
                .filter(value => !Number.isNaN(value) && value >= 1 && value <= 80);
        }

        function renderSelectedButtons() {
            const selected = new Set(getSelectedNumbers());
            numberButtons.forEach(button => {
                const number = parseInt(button.dataset.number, 10);
                const active = selected.has(number);
                button.classList.toggle('btn-primary', active);
                button.classList.toggle('btn-outline-secondary', !active);
            });

            if (counter) {
                counter.textContent = `Selecionados: ${selected.size}/5`;
                if (selected.size < 5) {
                    counter.textContent += ' - Você NÃO está participando dos RATEIOS automáticos!!!';
                } else {
                    counter.textContent += ' - Você ESTÁ participando dos RATEIOS automáticos!!!';
                }
            }
        }

        function showLimitWarning() {
            if (!limitWarning) {
                return;
            }

            limitWarning.classList.remove('d-none');

            if (warningTimeoutId) {
                clearTimeout(warningTimeoutId);
            }

            warningTimeoutId = setTimeout(() => {
                limitWarning.classList.add('d-none');
            }, 2000);
        }

        function writeSelectedNumbers(selected) {
            for (let index = 0; index < lotteryFields.length; index++) {
                lotteryFields[index].value = selected[index] ?? '';
            }
            renderSelectedButtons();
        }

        numberButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (button.disabled) {
                    return;
                }

                const number = parseInt(button.dataset.number, 10);
                const selected = getSelectedNumbers();
                const isActive = button.classList.contains('btn-primary');

                if (isActive) {
                    const index = selected.indexOf(number);
                    if (index !== -1) {
                        selected.splice(index, 1);
                    }
                    if (limitWarning) {
                        limitWarning.classList.add('d-none');
                    }
                    writeSelectedNumbers(selected);
                    return;
                }

                if (selected.length >= 5) {
                    showLimitWarning();
                    return;
                }

                selected.push(number);
                selected.sort((a, b) => a - b);
                writeSelectedNumbers(selected);
            });
        });

        renderSelectedButtons();
    })();
    </script>
@endsection
