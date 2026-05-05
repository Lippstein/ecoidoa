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
                $lotteryNumbers = isset($data['lotteryNumbers']) ? (array) $data['lotteryNumbers'] : [1,2,3,4,5];
                $availableBalance = isset($data['availableBalance']) ? $data['availableBalance'] : 'Saldo não cadastrado';
                $totalCredits = isset($data['totalCredits']) ? $data['totalCredits'] : 'Total de Créditos'; 
                $indebtedUsers = isset($data['indebtedUsers']) ? $data['indebtedUsers'] : 'Usuários Devedores';
                $totalDebts = isset($data['totalDebts']) ? $data['totalDebts'] : 'Total de Débitos'; 
                $creditorUsers = isset($data['creditorUsers']) ? $data['creditorUsers'] : 'Usuários Credores';
                $results = isset($data['results']) ? $data['results'] : 'Resultados não cadastrados';
                $lotteryNumbers = old('lotteryNumbers', $lotteryNumbers);
                $lotteryNumbers = is_array($lotteryNumbers) ? $lotteryNumbers : array_map('trim', explode(',', (string) $lotteryNumbers));
                $lotteryNumbers = array_values(array_slice(array_map('intval', $lotteryNumbers), 0, 5));
                $availableBalance = old('availableBalance', $data['availableBalance'] ?? '');
                $totalCredits = old('totalCredits', $data['totalCredits'] ?? '');
                $indebtedUsers = old('indebtedUsers', $data['indebtedUsers'] ?? '');
                $totalDebts = old('totalDebts', $data['totalDebts'] ?? '');
                $creditorUsers = old('creditorUsers', $data['creditorUsers'] ?? '');
                $results = old('results', $data['results'] ?? '');

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
                                <button type="button" class="btn w-100 number-picker {{ in_array($number, $lotteryNumbers) ? 'btn-primary' : 'btn-outline-secondary' }}" data-number="{{ $number }}" disabled>{{ $number }}</button>
                            </div>                            
                        @endforeach
                    </div>
                    <small id="lotteryNumbersCounter" class="form-text text-muted d-block mt-2">Selecionados: 0/5</small>
                    <div id="lotteryNumbersLimitWarning" class="alert alert-warning py-1 px-2 mt-2 mb-0 d-none" role="alert">
                        Você pode selecionar no máximo 5 números.
                    </div>
                </div>
            </div>




            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="lotteryNumbers"><strong>Números Escolhidos:</strong></label>
                <div class="col-sm-8">
                    <div class="row g-2">
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbers_0" name="lotteryNumbers[]" value="{{ $lotteryNumbers[0] ?? '' }}" readonly required autofocus>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbers_1" name="lotteryNumbers[]" value="{{ $lotteryNumbers[1] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbers_2" name="lotteryNumbers[]" value="{{ $lotteryNumbers[2] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbers_3" name="lotteryNumbers[]" value="{{ $lotteryNumbers[3] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white" min="1" max="80" step="1" id="lotteryNumbers_4" name="lotteryNumbers[]" value="{{ $lotteryNumbers[4] ?? '' }}" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="availableBalance"><strong>Saldo Disponível:</strong></label>
                <div class="col-sm-8">
                    <input type="number" class="form-control readonly-field bg-info text-white" id="availableBalance" name="availableBalance" value="{{ old('availableBalance', $availableBalance) }}" readonly required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalCredits"><strong>Total de Créditos:</strong></label>
                <div class="col-sm-8">
                    <input type="number" class="form-control readonly-field bg-info text-white" id="totalCredits" name="totalCredits" value="{{ old('totalCredits', $totalCredits) }}" readonly required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="indebtedUsers"><strong>Usuários Devedores:</strong></label>
                <div class="col-sm-8">
                    <a href="{{ 'route usersDataFlex_indebtedUsers.show' }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Fiéis depositários do Meu Crédito' }}
                    </a>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="totalDebts"><strong>Total de Débitos:</strong></label>
                <div class="col-sm-8">
                    <input type="number" class="form-control readonly-field bg-info text-white" id="totalDebts" name="totalDebts" value="{{ old('totalDebts', $totalDebts) }}" readonly required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="creditorUsers"><strong>Usuários Credores:</strong></label>
                <div class="col-sm-8">
                    <a href="{{ 'route usersDataFlex_creditorUsers.show' }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Usuários Credores dos meus Débitos' }}
                    </a>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="results"><strong>Resultados:</strong></label>
                <div class="col-sm-8">
                    <a href="{{ 'route usersDataFlex_results.show' }}" class="btn btn-link p-0 readonly-field bg-info text-white" >
                        {{ 'Ver o Resultado de todos os Rateios' }}
                    </a>
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

        const lotteryFields = document.querySelectorAll('[id^="lotteryNumbers_"]');
        const isReadonly = lotteryFields.length > 0 ? lotteryFields[0].hasAttribute('readonly') : true;
        document.querySelectorAll('.number-picker').forEach(button => {
            button.disabled = isReadonly;
        });
    }

    (function () {
        const numberButtons = Array.from(document.querySelectorAll('.number-picker'));
        const lotteryFields = Array.from(document.querySelectorAll('[id^="lotteryNumbers_"]'));
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
