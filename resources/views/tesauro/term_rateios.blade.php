@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Incluir Rateio do Termo: {{ request('id', $term->id ?? '') }} (Sorteio CEF)</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => request('niche_filter'), 'bt_filter' => request('bt_filter')]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    @php
        use Carbon\Carbon;
        // request do id do termo para montar o filtro dos rateios
        $idTermo = request('id', $term->id ?? '');
        $rateiosIdTermo = "ufcspa5_" . $idTermo . "_";
        $rateiosDoTermo = \App\Models\Term::where('term', 'like', '%' . $rateiosIdTermo . '%')->get();
        $qtdRateiosDoTermo = $rateiosDoTermo->count()+1;
        $seguinteNumero = "00000000".$qtdRateiosDoTermo;
        $ultimas6Posicoes = substr($seguinteNumero, -5);
        $nextTermName = $rateiosIdTermo . $ultimas6Posicoes;


        $totalRateio = isset($data['totalRateio']) ? $data['totalRateio'] : 0;
        $totalPrize = isset($data['totalPrize']) ? $data['totalPrize'] : 0;
        $availableBalance_Next = isset($data['availableBalance_Next']) ? $data['availableBalance_Next'] : 0;
        $availableBalance_Final5 = isset($data['availableBalance_Final5']) ? $data['availableBalance_Final5'] : 0;
        $availableBalance_Special = isset($data['availableBalance_Special']) ? $data['availableBalance_Special'] : 0;
        $totalRateio = old('totalRateio', $totalRateio ?? 0);
        $totalPrize = old('totalPrize', $totalPrize ?? 0);
        $availableBalance_Next = old('availableBalance_Next', $data['availableBalance_Next'] ?? 0);
        $availableBalance_Final5 = old('availableBalance_Final5', $data['availableBalance_Final5'] ?? 0);
        $availableBalance_Special = old('availableBalance_Special', $data['availableBalance_Special'] ?? 0);



    @endphp

        <form method="POST" action="{{ route('term_rateios.store', $term->id) }}"  class="m-4 question-form" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
            <input type="hidden" name="bt_filter" value="{{ request('bt_filter') }}">
            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
            <input type="hidden" name="nextTermName" value="{{ $nextTermName }}">
            <input type="hidden" name="term_order" value="{{ request('term_order') }}">
            <input type="hidden" name="totalRateio" value="{{ $totalRateio }}">
            <input type="hidden" name="totalPrize" value="{{ $totalPrize }}">
            <input type="hidden" name="availableBalance_Next" value="{{ $availableBalance_Next }}">
            <input type="hidden" name="availableBalance_Final5" value="{{ $availableBalance_Final5 }}">
            <input type="hidden" name="availableBalance_Special" value="{{ $availableBalance_Special }}">
            @php
                $data = $term->term_data ?? [];
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
                $participants = isset($data['participants']) ? $data['participants'] : '';
                $lotteryNumbers = old('lotteryNumbers', $lotteryNumbers);
                $lotteryNumbers = is_array($lotteryNumbers) ? $lotteryNumbers : array_map('trim', explode(',', (string) $lotteryNumbers));
                $lotteryNumbers = array_values(array_slice(array_map('intval', $lotteryNumbers), 0, 5));
                $participants = old('participants', $data['participants'] ?? ''); 
                $nextTermName = old('nextTermName', $nextTermName ?? '');
                $concourseCEFNumber = old('concourseCEFNumber', $concourseCEFNumber ?? '');
                $concourseCEFDate = old('concourseCEFDate', $concourseCEFDate  ?? '');
                $concourseCEFDateValue = $concourseCEFDate;
                if (!empty($concourseCEFDateValue)) {
                    try {
                        $concourseCEFDateValue = \Carbon\Carbon::parse($concourseCEFDateValue)->format('Y-m-d');
                    } catch (\Throwable $e) {
                        // Keep the original value if it cannot be parsed.
                    }
                }

                $concourseNumber = $concourseCEFNumber;
                $concourseDate = today()->toDateString();

                // Ex.: $concourseCEFDate = '2026-06-02'
                $dataConcurso = Carbon::createFromFormat('Y-m-d', $concourseDate)->startOfDay();
                $primeiraDataJunho = Carbon::create($dataConcurso->year, 6, 1)->startOfDay();
                // Se 1º de junho for domingo, usa 2 de junho
                if ($primeiraDataJunho->isSunday()) {
                    $primeiraDataJunho->addDay();
                }

            @endphp

            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="nextTermName"><strong>Rateio:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="nextTermName" name="nextTermName" value="{{ old('nextTermName', $nextTermName) }}" readonly required>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="concourseCEFNumber"><strong>Número Concurso:</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control bg-info text-white" id="concourseCEFNumber" name="concourseCEFNumber" value="{{ old('concourseCEFNumber', $concourseCEFNumber) }}" required>
                </div>
                <label  class="col-sm-2 col-form-label" for="concourseCEFDate"><strong>Data Concurso:</strong></label>
                <div class="col-sm-4">
                    <input type="date" class="form-control bg-info text-white" id="concourseCEFDate" name="concourseCEFDate" value="{{ $concourseCEFDateValue }}" required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="listNumbers"><strong>Números Sorteio:</strong></label>
                <div class="col-sm-10">
                    <div class="number-grid g-2">
                        @foreach ($listNumbers as $number)
                            <div>
                                <button type="button" class="btn w-100 number-picker {{ in_array($number, $lotteryNumbers) ? 'btn-primary' : 'btn-outline-secondary' }}" data-number="{{ $number }}" >{{ $number }}</button>
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
                <label  class="col-sm-2 col-form-label" for="lotteryNumbers"><strong>Números Sorteio:</strong></label>
                <div class="col-sm-8">
                    <div class="row g-2">
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white"  id="lotteryNumbers_0" name="lotteryNumbers[]" value="{{ $lotteryNumbers[0] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white"  id="lotteryNumbers_1" name="lotteryNumbers[]" value="{{ $lotteryNumbers[1] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white"  id="lotteryNumbers_2" name="lotteryNumbers[]" value="{{ $lotteryNumbers[2] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white"  id="lotteryNumbers_3" name="lotteryNumbers[]" value="{{ $lotteryNumbers[3] ?? '' }}" readonly required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control readonly-field bg-info text-white"  id="lotteryNumbers_4" name="lotteryNumbers[]" value="{{ $lotteryNumbers[4] ?? '' }}" readonly required>
                        </div>
                    </div>
                </div>
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