@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Editar Rateios do Termo </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => request('niche_filter'), 'bt_filter' => request('bt_filter')]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    @php
        // request do id do termo para montar o filtro dos rateios
        $idTermo = request('id', $term->id ?? '');
        $rateiosidTermo = "rateio_" . $idTermo . "_";
        $rateiosDoTermo = \App\Models\Term::where('term', 'like', '%' . $rateiosidTermo . '%')->get();
        $qtdRateiosDoTermo = $rateiosDoTermo->count()+1;
        $seguinteNumero = "00000000".$qtdRateiosDoTermo;
        $ultimas6Posicoes = substr($seguinteNumero, -5);
        $proximoTermo = "rateio_" . $idTermo . "_" . $ultimas6Posicoes;
    @endphp

        <form method="POST" action="{{ route('term_rateios.update', $term->id) }}"  class="m-3">
            @csrf
            @method('PUT')
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
 
                $proximoTermo = old('proximoTermo', $proximoTermo ?? '');
                $concursoCEFNumber = old('concursoCEFNumber', $concursoCEFNumber ?? '');
                $concursoCEFDate = old('concursoCEFDate', $concursoCEFDate  ?? '');
            @endphp

            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="proximoTermo"><strong>Rateio:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="proximoTermo" name="proximoTermo" value="{{ old('proximoTermo', $proximoTermo) }}" readonly required>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="concursoCEFNumber"><strong>Número Concurso CEF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control bg-info text-white" id="concursoCEFNumber" name="concursoCEFNumber" value="{{ old('concursoCEFNumber', $concursoCEFNumber) }}" required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="concursoCEFDate"><strong>Data Concurso CEF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control bg-info text-white" id="concursoCEFDate" name="concursoCEFDate" value="{{ old('concursoCEFDate', $concursoCEFDate) }}" required>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-2 col-form-label" for="listNumbers"><strong>Números Sorteio CEF:</strong></label>
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

{{-- 
    <form method="POST" action="{{ route('term_questions.update') }}" class="m-4" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="bt_filter" value="{{ request('bt_filter') }}">
        <input type="hidden" name="id" value="{{ request('id', $term->id ?? '') }}">
        <input type="hidden" name="proximoTermo" value="{{ $proximoTermo }}">
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Termo:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="term" name="term" value="{{ old('term', $term->term ?? '') }}" readonly>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="definition" class="col-sm-2 col-form-label"><strong>Tipo de questão:</strong></label>
            <div class="col">
                <select class="form-select" id="question_type" name="question_type">
                    <option value="">Selecione um tipo</option>
                    <option value="Resposta Única" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Resposta Única' ? 'selected' : '' }}>Múltipla Escolha - Resposta Única</option>
                    <option value="Resposta Múltipla" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Resposta Múltipla' ? 'selected' : '' }}>Múltipla Escolha - Resposta Múltipla</option>
                    <option value="Afirmação Incompleta" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Afirmação Incompleta' ? 'selected' : '' }}>Múltipla Escolha - Afirmação Incompleta</option>
                    <option value="Foco Negativo" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Foco Negativo' ? 'selected' : '' }}>Múltipla Escolha - Foco Negativo</option>
                    <option value="Asserção e Razão" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Asserção e Razão' ? 'selected' : '' }}>Múltipla Escolha - Asserção e Razão</option>
                    <option value="Associação (ou Correspondência)" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Associação (ou Correspondência)' ? 'selected' : '' }}>Múltipla Escolha - Associação (ou Correspondência)</option>
                    <option value="Lacuna (ou Completar)" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Lacuna (ou Completar)' ? 'selected' : '' }}>Múltipla Escolha - Lacuna (ou Completar)</option>
                    <option value="Ordenação ou Seriação" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Ordenação ou Seriação' ? 'selected' : '' }}>Múltipla Escolha - Ordenação ou Seriação</option>
                    <option value="Interpretação" {{ old('question_type', $term->term_data['question_type'] ?? '') == 'Interpretação' ? 'selected' : '' }}>Múltipla Escolha - Interpretação</option>
                </select>
            </div>
        </div>

        {{-- Painéis específicos por tipo de questão --}}
        <div id="panel-question-type" class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col">
                {{-- Resposta Única --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Resposta Única">
                    <p class="mb-1"><strong>Resposta Única</strong> — O formato mais comum. O aluno deve identificar a <em>única</em> alternativa correta (geralmente A–D).</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: enunciado + 4 alternativas, sendo 1 correta.</p>

                    <div class="row mb-2 mt-1">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="alternative_1" class="col-sm-2 col-form-label"><strong>Alternativa 1:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Digite a alternativa 1">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="expl_alt_1" class="col-sm-2 col-form-label">Explicação 1:</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Digite a explicação da alternativa 1">
                        </div>
                    </div>

                    <div class="row mb-2 mt-1">
                        <label for="alternative_2" class="col-sm-2 col-form-label"><strong>Alternativa 2:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Digite a alternativa 2">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="expl_alt_2" class="col-sm-2 col-form-label">Explicação 2:</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Digite a explicação da alternativa 2">
                        </div>
                    </div>

                    <div class="row mb-2 mt-1">
                        <label for="alternative_3" class="col-sm-2 col-form-label"><strong>Alternativa 3:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Digite a alternativa 3">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="expl_alt_3" class="col-sm-2 col-form-label">Explicação 3:</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Digite a explicação da alternativa 3">
                        </div>
                    </div>

                    <div class="row mb-2 mt-1">
                        <label for="alternative_4" class="col-sm-2 col-form-label"><strong>Alternativa 4:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Digite a alternativa 4">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="expl_alt_4" class="col-sm-2 col-form-label">Explicação 4:</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Digite a explicação da alternativa 4">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label class="col-sm-2 col-form-label"><strong>Opção Correta:</strong></label>
                        <div class="col">
                            <select class="form-select" id="correct_option" name="correct_option">
                                <option value="">Selecione a opção correta</option>
                                <option value="A" {{ old('correct_option', $term->term_data['correct_option'] ?? '') == 'A' ? 'selected' : '' }}>Alternativa A</option>
                                <option value="B" {{ old('correct_option', $term->term_data['correct_option'] ?? '') == 'B' ? 'selected' : '' }}>Alternativa B</option>
                                <option value="C" {{ old('correct_option', $term->term_data['correct_option'] ?? '') == 'C' ? 'selected' : '' }}>Alternativa C</option>
                                <option value="D" {{ old('correct_option', $term->term_data['correct_option'] ?? '') == 'D' ? 'selected' : '' }}>Alternativa D</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="language" class="col-sm-2 col-form-label"><strong>Idioma:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control" id="language" name="language" value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                        </div>
                        </div>
                    <div class="row mb-2 mt-1">
                        <label for="date" class="col-sm-2 col-form-label"><strong>Data:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control" id="date" name="date" value="{{ old('date', now()->format('d/m/Y')) }}" readonly placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="answers" class="col-sm-2 col-form-label"><strong>Respostas:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control" id="answers" name="answers" value="{{ old('answers', '') }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="hits" class="col-sm-2 col-form-label"><strong>Acertos:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control" id="hits" name="hits" value="{{ old('hits', '') }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2 mt-1">
                        <label for="user" class="col-sm-2 col-form-label"><strong>Usuário:</strong></label>
                        <div class="col">
                            <input type="text" class="form-control" id="user" name="user" value="{{ old('user', $term->term_data['user'] ?? '') }}" readonly>
                        </div>
                    </div> 
                </div>

                {{-- Resposta Múltipla --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Resposta Múltipla">
                    <p class="mb-1"><strong>Resposta Múltipla</strong> — Mais de uma alternativa pode estar correta; o aluno deve selecionar <em>todas</em> as opções válidas.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: enunciado + alternativas com múltiplas corretas.</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Digite a alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Digite a explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Digite a alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Digite a explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Digite a alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Digite a explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Digite a alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Digite a explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Afirmação Incompleta --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Afirmação Incompleta">
                    <p class="mb-1"><strong>Afirmação Incompleta</strong> — O enunciado apresenta uma frase incompleta que deve ser concluída logicamente por uma das alternativas.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: "A fotossíntese é o processo pelo qual as plantas ______."</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Digite a alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Digite a explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Digite a alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Digite a explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Digite a alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Digite a explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Foco Negativo --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Foco Negativo">
                    <p class="mb-1"><strong>Foco Negativo</strong> — O enunciado pede para identificar a alternativa <em>incorreta</em>, usando termos como "EXCETO", "NÃO" ou "É FALSO".</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: "Assinale a alternativa que NÃO corresponde a..."</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Digite a alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Digite a explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Digite a alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Digite a explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Digite a alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Digite a explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Asserção e Razão --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Asserção e Razão">
                    <p class="mb-1"><strong>Asserção e Razão</strong> — Apresenta duas afirmações conectadas pela palavra PORQUE. O aluno deve julgar se ambas são verdadeiras e se a segunda justifica a primeira.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: "I — [afirmação]. PORQUE II — [justificativa]."</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Digite a alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Digite a explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Digite a alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Digite a explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Digite a alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Digite a explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Digite a alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Digite a explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Associação (ou Correspondência) --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Associação (ou Correspondência)">
                    <p class="mb-1"><strong>Associação (ou Correspondência)</strong> — O aluno deve relacionar itens de duas colunas entre si.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: Coluna I (conceitos) ↔ Coluna II (definições).</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Lacuna (ou Completar) --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Lacuna (ou Completar)">
                    <p class="mb-1"><strong>Lacuna (ou Completar)</strong> — Texto com espaços em branco que devem ser preenchidos com as opções fornecidas nas alternativas.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: "A ______ é responsável pela respiração celular, localizada no ______."</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ordenação ou Seriação --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Ordenação ou Seriação">
                    <p class="mb-1"><strong>Ordenação ou Seriação</strong> — O aluno deve colocar itens ou eventos em uma sequência lógica, cronológica ou hierárquica específica.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: "Ordene as etapas do processo de A a E."</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Interpretação --}}
                <div class="question-panel border rounded p-3 d-none" data-type="Interpretação">
                    <p class="mb-1"><strong>Interpretação</strong> — Baseada na análise de um texto, gráfico, imagem ou mapa. O aluno deve compreender o material apresentado para escolher a resposta correta.</p>
                    <p class="text-muted small mb-0">Exemplo de estrutura: [texto/imagem/gráfico] seguido do enunciado e alternativas.</p>
                    <div class="row mb-2 mt-3">
                        <label for="statement" class="col-sm-2 col-form-label"><strong>Enunciado:</strong></label>
                        <div class="col">
                            <textarea class="form-control" id="statement" name="statement" rows="3" maxlength="512" placeholder="Digite o enunciado da questão">{{ old('statement', $term->term_data['statement'] ?? '') }}</textarea>
                            <div class="mt-3">
                                <input type="text" class="form-control mb-2" id="alternative_1" name="alternative_1" maxlength="256" value="{{ old('alternative_1', $term->term_data['alternative_1'] ?? '') }}" placeholder="Alternativa 1">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1" name="expl_alt_1" maxlength="512" value="{{ old('expl_alt_1', $term->term_data['expl_alt_1'] ?? '') }}" placeholder="Explicação da alternativa 1">
                                <input type="text" class="form-control mb-2" id="alternative_2" name="alternative_2" maxlength="256" value="{{ old('alternative_2', $term->term_data['alternative_2'] ?? '') }}" placeholder="Alternativa 2">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2" name="expl_alt_2" maxlength="512" value="{{ old('expl_alt_2', $term->term_data['expl_alt_2'] ?? '') }}" placeholder="Explicação da alternativa 2">
                                <input type="text" class="form-control mb-2" id="alternative_3" name="alternative_3" maxlength="256" value="{{ old('alternative_3', $term->term_data['alternative_3'] ?? '') }}" placeholder="Alternativa 3">
                                <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3" name="expl_alt_3" maxlength="512" value="{{ old('expl_alt_3', $term->term_data['expl_alt_3'] ?? '') }}" placeholder="Explicação da alternativa 3">
                                <input type="text" class="form-control mb-2" id="alternative_4" name="alternative_4" maxlength="256" value="{{ old('alternative_4', $term->term_data['alternative_4'] ?? '') }}" placeholder="Alternativa 4">
                                <input type="text" class="form-control form-control-sm" id="expl_alt_4" name="expl_alt_4" maxlength="512" value="{{ old('expl_alt_4', $term->term_data['expl_alt_4'] ?? '') }}" placeholder="Explicação da alternativa 4">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

         {{-- <div class="row mb-2">
            <label class="col-sm-2 col-form-label"><strong>Nova questão:</strong></label>
            <div class="col">
                <input type="file" name="new_question" class="form-control" accept=".pdf,.doc,.docx,image/*">
            </div>
        </div> --}}
{{-- 





        <div class="row mb-3">
            <button type="submit" value="Incluir" class="btn btn-primary">(+) Incluir Questão</button>
        </div>
    </form>
</div>

<script>
(function () {
    const select = document.getElementById('question_type');
    const panels = document.querySelectorAll('.question-panel');



    function showPanel(type) {
        panels.forEach(panel => panel.classList.add('d-none'));

        switch (type) {
            case 'Resposta Única':
            case 'Resposta Múltipla':
            case 'Afirmação Incompleta':
            case 'Foco Negativo':
            case 'Asserção e Razão':
            case 'Associação (ou Correspondência)':
            case 'Lacuna (ou Completar)':
            case 'Ordenação ou Seriação':
            case 'Interpretação':
                const panel = document.querySelector(`.question-panel[data-type="${CSS.escape(type)}"]`);
                if (panel) {
                    panel.classList.remove('d-none');
                }
                break;
            default:
                // nenhum painel exibido
                break;
        }
    }

    select.addEventListener('change', () => showPanel(select.value));

    // exibir painel ao carregar caso já haja seleção
    if (select.value) {
        showPanel(select.value);
    }
})();
</script>
@endsection
 --}} --}}
