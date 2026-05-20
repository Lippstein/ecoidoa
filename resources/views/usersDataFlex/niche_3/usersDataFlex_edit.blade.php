@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Editar Perfil do Usuário - Nicho {{ $niche->id }}</h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <button type="button" class="btn btn-warning" onclick="toggleReadonly()">
                Habilitar Edição
            </button>
            <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info">Voltar Lista Perfil</a>
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

        <form method="POST" action="{{ route('usersDataFlex_update.show', $userDataFlex->id) }}"  class="m-3">
            @csrf
            @method('PUT')
            @php
                $data = $userDataFlex->user_profile;
                if (is_string($data)) {
                    try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
                }
                $listNumbers = [1,2,3,4,5,6,7,8,9,10,
                                11,12,13,14,15,16,17,18,19,20,
                                21,22,23,24,25,26,27,28,29,30,
                                31,32,33,34,35,36,37,38,39,40,
                                41,42,43,44,45,46,47,48,49,50,
                                51,52,53,54,55,56,57,58,59,60,
                                61,62,63,64,65,66,67,68,69,70,
                                71,72,73,74,75,76,77,78,79,80
                            ];
                $lotteryNumbersUser = isset($data['lotteryNumbersUser']) ? (array) $data['lotteryNumbersUser'] : [1,2,3,4,5];
                $availableBalance = isset($data['availableBalance']) ? $data['availableBalance'] : 100;
                $totalCredits = isset($data['totalCredits']) ? $data['totalCredits'] : 0; 
                $indebtedUsers = isset($data['indebtedUsers']) ? $data['indebtedUsers'] : 'Usuários Devedores';
                $totalDebts = isset($data['totalDebts']) ? $data['totalDebts'] : 0; 
                $creditorUsers = isset($data['creditorUsers']) ? $data['creditorUsers'] : 'Usuários Credores';
                $results = isset($data['results']) ? $data['results'] : 'Resultados não cadastrados';
                $maintenance = isset($data['maintenance']) ? $data['maintenance'] : 0;
                $lotteryNumbersUser = old('lotteryNumbersUser', $lotteryNumbersUser);
                $lotteryNumbersUser = is_array($lotteryNumbersUser) ? $lotteryNumbersUser : array_map('trim', explode(',', (string) $lotteryNumbersUser));
                $lotteryNumbersUser = array_values(array_slice(array_map('intval', $lotteryNumbersUser), 0, 5));
                $availableBalance = old('availableBalance', $data['availableBalance'] ?? 100);
                $totalCredits = old('totalCredits', $data['totalCredits'] ?? 0);
                $indebtedUsers = old('indebtedUsers', $data['indebtedUsers'] ?? '');
                $totalDebts = old('totalDebts', $data['totalDebts'] ?? 0);
                $creditorUsers = old('creditorUsers', $data['creditorUsers'] ?? '');
                $results = old('results', $data['results'] ?? '');
                $maintenance = old('maintenance', $data['maintenance'] ?? 0);

                $moneyToFloat = static function ($value): float {
                    if (!is_string($value)) {
                        return (float) $value;
                    }

                    $normalized = str_replace(['R$', ' '], '', trim($value));
                    $hasComma = str_contains($normalized, ',');
                    $hasDot = str_contains($normalized, '.');

                    // Aceita "1234.56", "1.234,56" e "1234,56".
                    if ($hasComma && $hasDot) {
                        $lastComma = strrpos($normalized, ',');
                        $lastDot = strrpos($normalized, '.');

                        if ($lastComma !== false && $lastDot !== false && $lastComma > $lastDot) {
                            $normalized = str_replace('.', '', $normalized);
                            $normalized = str_replace(',', '.', $normalized);
                        } else {
                            $normalized = str_replace(',', '', $normalized);
                        }
                    } elseif ($hasComma) {
                        $normalized = str_replace('.', '', $normalized);
                        $normalized = str_replace(',', '.', $normalized);
                    } else {
                        $normalized = str_replace(',', '', $normalized);
                    }

                    return (float) $normalized;
                };

                $formatCurrency = static function ($value) use ($moneyToFloat): string {
                    return 'R$ ' . number_format($moneyToFloat($value), 2, ',', '.');
                };

                $maintenanceDisplay = $formatCurrency($maintenance);
                $availableBalanceDisplay = $formatCurrency($availableBalance);
                $totalCreditsDisplay = $formatCurrency($totalCredits);
                $totalDebtsDisplay = $formatCurrency($totalDebts);
            @endphp
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="listNumbers"><strong>Escolha os Números:</strong></label>
                <div class="col-sm-10">
                    <div class="number-grid g-2">
                        @foreach ($listNumbers as $number)
                            <div>
                                <button type="button" class="btn w-100 number-picker {{ in_array($number, $lotteryNumbersUser) ? 'btn-primary' : 'btn-outline-secondary' }}" data-number="{{ $number }}">{{ $number }}</button>
                            </div>                            
                        @endforeach
                    </div>
                    <small id="lotteryNumbersCounter" class="form-text text-muted d-block mt-2">Selecionados: {{ count($lotteryNumbersUser) }}/5</small>
                    <div id="lotteryNumbersLimitWarning" class="alert alert-warning py-1 px-2 mt-2 mb-0 d-none" role="alert">
                        Você pode selecionar no máximo 5 números.
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="lotteryNumbersUser"><strong>Números Escolhidos:</strong></label>
                <div class="col-sm-8">
                    <div class="row g-2">
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbersUser_0" name="lotteryNumbersUser[]" value="{{ $lotteryNumbersUser[0] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbersUser_1" name="lotteryNumbersUser[]" value="{{ $lotteryNumbersUser[1] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbersUser_2" name="lotteryNumbersUser[]" value="{{ $lotteryNumbersUser[2] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbersUser_3" name="lotteryNumbersUser[]" value="{{ $lotteryNumbersUser[3] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbersUser_4" name="lotteryNumbersUser[]" value="{{ $lotteryNumbersUser[4] ?? '' }}" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="maintenance"><strong>Manutenção:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="maintenance" name="maintenance" value="{{ $maintenanceDisplay }}" readonly>
                </div>
            </div>

            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="availableBalance"><strong>Saldo Disponível:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="availableBalance" name="availableBalance" value="{{ $availableBalanceDisplay }}" readonly>
                </div>
                {{-- <div class="col-sm-5">
                    <a href="{{ route('usersDataFlex_results.show', ['udf_id' => $userDataFlex->id]) }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Resultados de todos os Rateios' }}
                    </a>
                </div> --}}
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalCredits"><strong>Total de Créditos:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="totalCredits" name="totalCredits" value="{{ $totalCreditsDisplay }}" readonly>
                </div>
                {{-- <div class="col-sm-5">
                    <a href="{{ route('usersDataFlex_indebtedUsers.show', ['udf_id' => $userDataFlex->id]) }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Devedores dos meus Créditos' }}
                    </a>
                </div> --}}
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalDebts"><strong>Total de Débitos:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="totalDebts" name="totalDebts" value="{{ $totalDebtsDisplay }}" readonly>
                </div>
                {{-- <div class="col-sm-5">
                    <a href="{{ route('usersDataFlex_creditorUsers.show', ['udf_id' => $userDataFlex->id]) }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Credores dos meus Débitos' }}
                    </a>
                </div> --}}
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>

        <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <strong>Lista de todos os Rateios do Usuário ({{ $user->name }} - Perfil ID: {{ $userDataFlex->id }} - Niche ID: {{ $userDataFlex->niche_id }})</strong>
            </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    @php
                        $formatMoneyRateio = static fn ($value): string => 'R$ ' . number_format((float) $value, 2, ',', '.');
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
                                                <div><strong>Data:</strong> {{ $rateio['concourseCEFDate'] ?? '-' }}</div>
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

                                            {{-- <div class="mb-2">
                                                <strong>Números do rateio:</strong><br>
                                                @forelse ($numbersRateio as $number)
                                                    <span class="badge number-badge {{ isset($numbersUserSet[$number]) ? 'bg-success' : 'bg-dark' }}">{{ $number }}</span>
                                                @empty
                                                    <span class="text-muted">Sem números sorteados.</span>
                                                @endforelse
                                            </div> --}}

                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>Contribuição:</strong> {{ $formatMoneyRateio($participant['contribution'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Total Rateio:</strong> {{ $formatMoneyRateio($rateio['totalRateio'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Total Premio:</strong> {{ $formatMoneyRateio($rateio['totalPrize'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>Acum. Próximo:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Next'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Acum. Final 5:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Final5'] ?? 0) }}</div>
                                                <div class="col-md-3"><strong>Acum. Especial:</strong> {{ $formatMoneyRateio($rateio['availableBalance_Special'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>5 acertos:</strong> {{ count($rateio['5_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['5_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 5 acertos:</strong> {{ $formatMoneyRateio(count($rateio['5_hits'] ?? []) > 0 ? $rateio['value_5_hits']/count($rateio['5_hits']) : $rateio['value_5_hits'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>4 acertos:</strong> {{ count($rateio['4_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['4_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 4 acertos:</strong> {{ $formatMoneyRateio(count($rateio['4_hits'] ?? []) > 0 ? $rateio['value_4_hits']/count($rateio['4_hits']) : $rateio['value_4_hits'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>3 acertos:</strong> {{ count($rateio['3_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['3_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 3 acertos:</strong> {{ $formatMoneyRateio(count($rateio['3_hits'] ?? []) > 0 ? $rateio['value_3_hits']/count($rateio['3_hits']) : $rateio['value_3_hits'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>2 acertos:</strong> {{ count($rateio['2_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['2_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 2 acertos:</strong> {{ $formatMoneyRateio(count($rateio['2_hits'] ?? []) > 0 ? $rateio['value_2_hits']/count($rateio['2_hits']) : $rateio['value_2_hits'] ?? 0) }}</div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-3"><strong>1 acertos:</strong> {{ count($rateio['1_hits'] ?? []) }} Ganhador(es)</div>
                                                <div class="col-md-3"><strong>{{ count($rateio['1_hits'] ?? []) > 0 ? "Prêmio" : "Acumulado" }} 1 acertos:</strong> {{ $formatMoneyRateio(count($rateio['1_hits'] ?? []) > 0 ? $rateio['value_1_hits']/count($rateio['1_hits']) : $rateio['value_1_hits'] ?? 0) }}</div>
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
