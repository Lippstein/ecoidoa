@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Editar Perfil do Usuário - Nicho {{ $niche->id }}</h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            @if (Auth::user()->level >= 5)
                <button type="button" class="btn btn-warning" onclick="toggleReadonly()">
                    Habilitar Edição
                </button>
                <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info">Lista de Perfis</a>
                <a href="{{ route('usersDataFlex_resultados.show', ['user_id' => $userDataFlex->user_id, 'niche_id' => $userDataFlex->niche_id]) }}" class="btn btn-info">Resultados</a>
            @else
                <a href="{{ route('usersDataFlex_resultados.show', ['user_id' => $userDataFlex->user_id, 'niche_id' => $userDataFlex->niche_id]) }}" class="btn btn-info">Resultados</a>
            @endif
        </div>
        <div class="row mb-2">
            <div>
              Perfil (ID): <strong> {{ $userDataFlex->id }} </strong> - Habitat_ID: <strong> {{ $userDataFlex->habitat_id }} </strong> - Niche_ID: <strong> {{ $userDataFlex->niche_id }} </strong> - Niche_Level: <strong> {{ $userDataFlex->niche_level }} </strong>
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
                $nicheLevel = $userDataFlex->niche_level;
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
                $invite = isset($data['invite']) ? $data['invite'] : 'Convite não gerado';
                $nicheLevel = old('niche_level', $userDataFlex->niche_level ?? 0);
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
                $invite = old('invite', $data['invite'] ?? '');
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
                <label  class="col-sm-2 col-form-label" for="nicheLevel"><strong>Nível de Nicho:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="nicheLevel" name="nicheLevel" value="{{ old('nicheLevel', $nicheLevel) }}" readonly required autofocus>
                </div>
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
                    <small id="lotteryNumbersCounter" class="form-text text-muted d-block mt-2">Para NÃO participar, deixe pelo menos um número em branco. Selecionados: {{ count($lotteryNumbersUser) }}/5</small>
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
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalCredits"><strong>Total de Créditos:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="totalCredits" name="totalCredits" value="{{ $totalCreditsDisplay }}" readonly>
                </div>

            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalDebts"><strong>Total de Débitos:</strong></label>
                <div class="col-sm-3">
                    <input type="text" inputmode="decimal" class="form-control readonly-field bg-info text-white" id="totalDebts" name="totalDebts" value="{{ $totalDebtsDisplay }}" readonly>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="invite"><strong>Senha de Convite:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="invite" name="invite" value="{{ $invite }}">
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
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
