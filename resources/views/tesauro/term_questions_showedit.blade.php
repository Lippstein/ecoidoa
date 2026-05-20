@extends('layouts.app')
@section('title', 'Idoa')
@section('content')
    <link href="https://unpkg.com/katex@0.12.0/dist/katex.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .statement-editor {
            background: #fffaaa;
            margin-bottom: 0.75rem;
        }

        .statement-editor .ql-toolbar {
            border-radius: 4px 4px 0 0;
        }

        .statement-editor .ql-container {
            border-radius: 0 0 4px 4px;
            height: 120px !important;
            overflow: visible;
        }

        .statement-editor .ql-editor {
            height: 120px !important;
            overflow-y: auto;
            padding-bottom: 4px;
        }

        /* Garante que o tooltip não vaze sobre campos abaixo */
        .statement-editor .ql-tooltip {
            z-index: 100;
        }

        .ql-custom-formula {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: auto !important;
            padding: 0 6px !important;
        }

        .ql-custom-formula::before {
            content: 'f(x)';
            font-size: 14px;
            font-style: italic;
            font-weight: bold;
            line-height: 1;
        }
    </style>

    <!-- Modal KaTeX -->
    <div class="modal fade" id="formulaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inserir Fórmula LaTeX</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="formulaLatexInput" class="form-control" placeholder="Ex: x^2 + \frac{a}{b}">
                    <div id="formulaPreview" class="mt-2 p-2 border rounded bg-light" style="min-height:40px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="formulaInsertBtn">Inserir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Editar/Ver Questão do Termo</h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter]) }}"
                class="btn btn-info">Voltar para o Tesauro</a>
        </div>
        @php

            $idTermo = request('id', $term->id ?? '');
            $termName = $term->term ?? '';

            // Carrega os dados da questao pelo idTermo na tabela terms
            $termData = is_array($term->term_data ?? null) ? $term->term_data : [];
            $questionData = data_get($termData, 'questions.0', []);

            $getQuestionField = function (string $field, $default = '') use ($termData, $questionData) {
                return data_get($termData, $field, data_get($questionData, $field, $default));
            };


            // $question = 'question_' . $idTermo . '_';
            $questionsDoTermo = \App\Models\Term::where('id', $idTermo)->get();
            // $qtdQuestionsDoTermo = $questionsDoTermo->count() + 1;
            // $seguinteNumero = '00000000' . $qtdQuestionsDoTermo;
            // $ultimas6Posicoes = substr($seguinteNumero, -5);
            // $termName = 'question_' . $idTermo . '_' . $ultimas6Posicoes;

            // valores padrão (evita Undefined variable)
             // $question_type = '';

             

            $statement = old('statement', $getQuestionField('statement', ''));
            $alternative_1 = old('alternative_1', $getQuestionField('alternative_1', ''));
            $expl_alt_1 = old('expl_alt_1', $getQuestionField('expl_alt_1', ''));
            $alternative_2 = old('alternative_2', $getQuestionField('alternative_2', ''));
            $expl_alt_2 = old('expl_alt_2', $getQuestionField('expl_alt_2', ''));
            $alternative_3 = old('alternative_3', $getQuestionField('alternative_3', ''));
            $expl_alt_3 = old('expl_alt_3', $getQuestionField('expl_alt_3', ''));
            $alternative_4 = old('alternative_4', $getQuestionField('alternative_4', ''));
            $expl_alt_4 = old('expl_alt_4', $getQuestionField('expl_alt_4', ''));
            $correct_option = old('correct_option', $getQuestionField('correct_option', ''));
            $dificulty = old('dificulty', $getQuestionField('dificulty', ''));
            $answers = old('answers', $getQuestionField('answers', 3));
            $hits = old('hits', $getQuestionField('hits', 1));

            $definition = '';
            $id_niche = old('niche_filter', $niche_filter ?? ($term->id_niche ?? ''));
            $language = 'pt_BR';
            $date = now()->format('d/m/Y');

            $userId = auth()->id() ?? 0;
            $userName = auth()->user()?->name ?? 'Desconhecido';

            // buscar o termBT do id do termo para mostrar o nome do BT no título da página
            $termNT = \App\Models\Relation::where('id_term_nt', $term->id)->first();  
            $termBTdoNT = $termNT->id_term_bt ?? null;
            $termBT = \App\Models\Term::where('id', $termBTdoNT)->first();
            $nameBT = $termBT->term ?? 'BT Desconhecido';

        @endphp


        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <strong>Resposta Única</strong>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormSingle" method="POST" action="{{ route('term_questions.update') }}"
                            class="m-4 question-form" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Resposta_Unica">

                            {{-- Resposta Única --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Resposta Única</strong> — O formato mais comum. O aluno deve
                                    identificar a <em>única</em> alternativa correta (geralmente A–D).</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: enunciado + 4 alternativas, sendo 1
                                    correta.</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement" class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="512"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1"
                                            name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="512"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2"
                                            name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="512"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3"
                                            name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="512"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_4"
                                            name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <strong>Resposta Múltipla</strong>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormMultiple" method="POST" action="{{ route('term_questions.update') }}"
                            class="m-4 question-form" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Resposta_Multipla">
                            {{-- Resposta Múltipla --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Resposta Múltipla</strong> — Mais de uma alternativa pode estar
                                    correta; o aluno deve selecionar <em>todas</em> as opções válidas.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: enunciado + alternativas com
                                    múltiplas corretas.</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement" class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1"
                                            name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2"
                                            name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3"
                                            name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_4"
                                            name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <strong>Afirmacao Incompleta</strong>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormAfirmacaoIncompleta" method="POST"
                            action="{{ route('term_questions.update') }}" class="m-4 question-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Afirmacao_Incompleta">
                            {{-- Afirmação Incompleta --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Afirmação Incompleta</strong> — O enunciado apresenta uma frase
                                    incompleta que deve ser concluída logicamente por uma das alternativas.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: "A fotossíntese é o processo pelo
                                    qual as plantas ______."</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement" class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1"
                                            name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2"
                                            name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3"
                                            name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_4"
                                            name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        <strong>Foco Negativo</strong>
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormFocoNegativo" method="POST" action="{{ route('term_questions.update') }}"
                            class="m-4 question-form" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Foco_Negativo">
                            {{-- Foco Negativo --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Foco Negativo</strong> — O enunciado pede para identificar a
                                    alternativa
                                    <em>incorreta</em>, usando termos como "EXCETO", "NÃO" ou "É FALSO".
                                </p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: "Assinale a alternativa que NÃO
                                    corresponde a..."</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement" class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_1"
                                            name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_2"
                                            name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_3"
                                            name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2" id="expl_alt_4"
                                            name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        <strong>Asserção e Razão</strong>
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormAssercaoRazao" method="POST" action="{{ route('term_questions.update') }}"
                            class="m-4 question-form" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Assercao_Razao">
                            {{-- Asserção e Razão --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Asserção e Razão</strong> — Apresenta duas afirmações conectadas
                                    pela palavra
                                    PORQUE. O aluno deve julgar se ambas são verdadeiras e se a segunda justifica a
                                    primeira.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: "I — [afirmação]. PORQUE II —
                                    [justificativa]."</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement" class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_1" name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_2" name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_3" name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_4" name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        <strong>Associação (ou Correspondência)</strong>
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormAssociacaoCorrespondencia" method="POST"
                            action="{{ route('term_questions.update') }}" class="m-4 question-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Associacao_Correspondencia">
                            {{-- Associação (ou Correspondência) --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Associação (ou Correspondência)</strong> — O aluno deve
                                    relacionar itens de duas
                                    colunas entre si.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: Coluna I (conceitos) ↔ Coluna II
                                    (definições).</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement"
                                        class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_1" name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_2" name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_3" name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_4" name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSeven" aria-expanded="false"
                        aria-controls="flush-collapseSeven">
                        <strong>Lacuna (ou Completar)</strong>
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormLacunaCompletar" method="POST"
                            action="{{ route('term_questions.update') }}" class="m-4 question-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Lacuna_Completar">
                            {{-- Lacuna (ou Completar) --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Lacuna (ou Completar)</strong> — Texto com espaços em branco que
                                    devem ser preenchidos com as opções fornecidas nas alternativas.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: "A ______ é responsável pela
                                    respiração celular, localizada no ______."</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement"
                                        class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_1" name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_2" name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_3" name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_4" name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseEight" aria-expanded="false"
                        aria-controls="flush-collapseEight">
                        <strong>Ordenação ou Seriação</strong>
                    </button>
                </h2>
                <div id="flush-collapseEight" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormOrdenacaoSeriacao" method="POST"
                            action="{{ route('term_questions.update') }}" class="m-4 question-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Ordenacao_Seriacao">
                            {{-- Ordenação ou Seriação --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Ordenação ou Seriação</strong> — O aluno deve colocar itens ou
                                    eventos em uma
                                    sequência lógica, cronológica ou hierárquica específica.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: "Ordene as etapas do processo de A
                                    a E."</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement"
                                        class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_1" name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_2" name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_3" name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_4" name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                        <strong>Interpretação</strong>
                    </button>
                </h2>
                <div id="flush-collapseNine" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form id="questionFormInterpretacao" method="POST"
                            action="{{ route('term_questions.update') }}" class="m-4 question-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="niche_filter" value="{{ old('niche_filter', $niche_filter) }}">
                            <input type="hidden" name="bt_filter" value="{{ old('bt_filter', $bt_filter) }}">
                            <input type="hidden" name="term_id" value="{{ request('id', $term->id ?? '') }}">
                            <input type="hidden" name="question_type" value="Interpretacao">
                            {{-- Interpretação --}}
                            <div class="border rounded row mb-2">
                                <p class="mb-1"><strong>Interpretação</strong> — Baseada na análise de um texto,
                                    gráfico, imagem ou mapa.
                                    O aluno deve compreender o material apresentado para escolher a resposta correta.</p>
                                <p class="text-muted small mb-0">Exemplo de estrutura: [texto/imagem/gráfico] seguido do
                                    enunciado e alternativas.</p>
                            </div>
                            <div class="row mb-2">
                                <label for="term" class="col-sm-2 col-form-label fw-semibold">Questão
                                    {{ substr($termName, -2) }}:</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="term" name="term"
                                        value="{{ old('term', $term->term ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2 mt-1">
                                    <label for="statement"
                                        class="col-sm-2 col-form-label fw-semibold">Enunciado:</label>
                                    <div class="col">
                                        <input type="hidden" name="statement" class="statement-input"
                                            value="{{ old('statement', $statement) }}">
                                        <div class="statement-editor"></div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="alternative_1" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_1"
                                            name="alternative_1" maxlength="1024"
                                            value="{{ old('alternative_1', $alternative_1) }}"
                                            placeholder="Digite a alternativa 1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_1" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        1:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_1" name="expl_alt_1" maxlength="512"
                                            value="{{ old('expl_alt_1', $expl_alt_1) }}"
                                            placeholder="Digite a explicação da alternativa 1" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_2" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_2"
                                            name="alternative_2" maxlength="256"
                                            value="{{ old('alternative_2', $alternative_2) }}"
                                            placeholder="Digite a alternativa 2" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_2" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        2:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_2" name="expl_alt_2" maxlength="512"
                                            value="{{ old('expl_alt_2', $expl_alt_2) }}"
                                            placeholder="Digite a explicação da alternativa 2" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_3" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_3"
                                            name="alternative_3" maxlength="256"
                                            value="{{ old('alternative_3', $alternative_3) }}"
                                            placeholder="Digite a alternativa 3" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_3" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        3:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_3" name="expl_alt_3" maxlength="512"
                                            value="{{ old('expl_alt_3', $expl_alt_3) }}"
                                            placeholder="Digite a explicação da alternativa 3" required>
                                    </div>
                                </div>

                                <div class="row mb-2 mt-1">
                                    <label for="alternative_4" class="col-sm-2 col-form-label fw-semibold">Alternativa
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control mb-2" id="alternative_4"
                                            name="alternative_4" maxlength="256"
                                            value="{{ old('alternative_4', $alternative_4) }}"
                                            placeholder="Digite a alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="expl_alt_4" class="col-sm-2 col-form-label fw-semibold">Explicação
                                        4:</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm mb-2"
                                            id="expl_alt_4" name="expl_alt_4" maxlength="512"
                                            value="{{ old('expl_alt_4', $expl_alt_4) }}"
                                            placeholder="Digite a explicação da alternativa 4" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label class="col-sm-2 col-form-label fw-semibold">Opção Correta:</label>
                                    <div class="col">
                                        <select class="form-select" id="correct_option" name="correct_option">
                                            <option value="">Selecione a opção correta</option>
                                            <option value="A"
                                                {{ old('correct_option', $correct_option) == 'A' ? 'selected' : '' }}>
                                                Alternativa A</option>
                                            <option value="B"
                                                {{ old('correct_option', $correct_option) == 'B' ? 'selected' : '' }}>
                                                Alternativa B</option>
                                            <option value="C"
                                                {{ old('correct_option', $correct_option) == 'C' ? 'selected' : '' }}>
                                                Alternativa C</option>
                                            <option value="D"
                                                {{ old('correct_option', $correct_option) == 'D' ? 'selected' : '' }}>
                                                Alternativa D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="language" class="col-sm-2 col-form-label fw-semibold">Idioma:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="language" name="language"
                                            value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="date" class="col-sm-2 col-form-label fw-semibold">Data:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="date" name="date"
                                            value="{{ old('date', $date) }}" readonly placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="dificulty"
                                        class="col-sm-2 col-form-label fw-semibold">Dificuldade:</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="dificulty" name="dificulty"
                                            value="{{ old('dificulty', $dificulty) }}" readonly>
                                    </div>
                                    <label for="answers" class="col-sm-2 col-form-label fw-semibold">Respostas:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="answers"
                                            name="answers" value="{{ old('answers', $answers) }}" min="1"
                                            step="1" required>
                                    </div>
                                    <label for="hits" class="col-sm-2 col-form-label fw-semibold">Acertos:</label>
                                    <div class="col">
                                        <input type="number" class="form-control fw-semibold" id="hits"
                                            name="hits" value="{{ old('hits', $hits) }}" min="1"
                                            step="1" required>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-1">
                                    <label for="userId" class="col-sm-2 col-form-label fw-semibold">Usuário:</label>
                                    <div class="col">
                                        <input type="text" class="form-control fw-semibold" id="userId"
                                            name="userId" value="{{ old('userId', $userId) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" value="Incluir" class="btn btn-primary">Alterar 
                                    Questão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="card mt-4">
            <div class="card-header">
                Questão: {{ substr($term->term, -5) }} - <strong>{{ $nameBT }}</strong>
            </div>
            <div class="card-body">
                {{-- <p class="mb-2"><strong>Enunciado:</strong></p> --}}
                <div class="border rounded p-2 bg-light mb-3">{!! $statement ?: '<span class="text-muted">Sem enunciado cadastrado.</span>' !!}</div>

                {{-- <p class="mb-2"><strong>Alternativas:</strong></p> --}}
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>A)</strong> {{ $alternative_1 ?: '---' }}</li>
                    <li class="list-group-item"><strong>B)</strong> {{ $alternative_2 ?: '---' }}</li>
                    <li class="list-group-item"><strong>C)</strong> {{ $alternative_3 ?: '---' }}</li>
                    <li class="list-group-item"><strong>D)</strong> {{ $alternative_4 ?: '---' }}</li>
                </ul>

                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#answer-details-{{ $idTermo }}" aria-expanded="false"
                    aria-controls="answer-details-{{ $idTermo }}">
                    Ver Resposta
                </button>

                <div id="answer-details-{{ $idTermo }}" class="collapse mt-3">
                    <div class="border rounded p-3 bg-light">
                        <p class="mb-2"><strong>Opção correta:</strong> {{ $correct_option ?: '-' }}</p>
                        {{-- <p class="mb-1"><strong>Explicações:</strong></p> --}}
                        <ul class="mb-0">
                            <li><strong>A:</strong> {{ $expl_alt_1 ?: '---' }}</li>
                            <li><strong>B:</strong> {{ $expl_alt_2 ?: '---' }}</li>
                            <li><strong>C:</strong> {{ $expl_alt_3 ?: '---' }}</li>
                            <li><strong>D:</strong> {{ $expl_alt_4 ?: '---' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>





    <script>
        function initStatementEditors() {
            const questionForms = document.querySelectorAll('form.question-form');

            questionForms.forEach((formEl) => {
                const hiddenInput = formEl.querySelector('.statement-input');
                const editorContainer = formEl.querySelector('.statement-editor');

                if (!hiddenInput || !editorContainer || typeof Quill === 'undefined') {
                    return;
                }

                const quill = new Quill(editorContainer, {
                    theme: 'snow',
                    modules: {
                        toolbar: {
                            container: [
                                [{
                                    header: [1, 2, 3, false]
                                }],
                                [{
                                    size: ['small', false, 'large', 'huge']
                                }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{
                                    list: 'ordered'
                                }, {
                                    list: 'bullet'
                                }],
                                [{
                                    align: []
                                }],
                                ['link', 'blockquote', 'code-block'],
                                [{
                                    'custom-formula': 'formula'
                                }],
                                ['clean']
                            ],
                            handlers: {
                                'custom-formula': function() {
                                    window._activeQuill = this.quill;
                                    document.getElementById('formulaLatexInput').value = '';
                                    document.getElementById('formulaPreview').innerHTML = '';
                                    var modal = new bootstrap.Modal(document.getElementById(
                                        'formulaModal'));
                                    modal.show();
                                }
                            }
                        }
                    },
                    placeholder: 'Digite o enunciado da questão'
                });

                if (hiddenInput.value && hiddenInput.value.trim() !== '') {
                    quill.root.innerHTML = hiddenInput.value;
                }

                const syncStatement = () => {
                    const html = quill.root.innerHTML.trim();
                    const text = quill.getText().trim();
                    hiddenInput.value = text ? html : '';
                };

                quill.on('text-change', syncStatement);

                formEl.addEventListener('submit', () => {
                    syncStatement();
                });
            });
        }

        function applyDifficultyRules(formEl) {
            const answersInput = formEl.querySelector('input[name="answers"]');
            const hitsInput = formEl.querySelector('input[name="hits"]');
            const difficultyInput = formEl.querySelector('input[name="dificulty"]');

            if (!answersInput || !hitsInput || !difficultyInput || answersInput.readOnly || hitsInput.readOnly) {
                return;
            }

            function clearValidity() {
                answersInput.setCustomValidity('');
                hitsInput.setCustomValidity('');
            }

            function updateDifficultyAndValidity() {
                clearValidity();

                const answersRaw = answersInput.value.trim();
                const hitsRaw = hitsInput.value.trim();

                if (answersRaw === '' || hitsRaw === '') {
                    difficultyInput.value = '';
                    return;
                }

                const answers = Number(answersRaw);
                const hits = Number(hitsRaw);

                if (Number.isInteger(answers) && answers > 0) {
                    hitsInput.setAttribute('max', String(answers));
                } else {
                    hitsInput.removeAttribute('max');
                }

                if (!Number.isInteger(answers) || answers <= 0) {
                    answersInput.setCustomValidity('Respostas deve ser um numero inteiro maior que zero.');
                    difficultyInput.value = '';
                    return;
                }

                if (!Number.isInteger(hits) || hits <= 0) {
                    hitsInput.setCustomValidity('Acertos deve ser um numero inteiro maior que zero.');
                    difficultyInput.value = '';
                    return;
                }

                if (hits > answers) {
                    hitsInput.setCustomValidity('Acertos deve ser menor ou igual a Respostas.');
                    difficultyInput.value = '';
                    return;
                }

                const ratio = hits / answers;
                if (ratio <= 0.34) {
                    difficultyInput.value = 'difícil';
                } else if (ratio < 0.68) {
                    difficultyInput.value = 'médio';
                } else {
                    difficultyInput.value = 'fácil';
                }
            }

            answersInput.addEventListener('input', updateDifficultyAndValidity);
            hitsInput.addEventListener('input', updateDifficultyAndValidity);
            answersInput.addEventListener('change', updateDifficultyAndValidity);
            hitsInput.addEventListener('change', updateDifficultyAndValidity);

            formEl.addEventListener('submit', (event) => {
                updateDifficultyAndValidity();
                const answers = Number(answersInput.value);
                const hits = Number(hitsInput.value);

                if (Number.isInteger(answers) && Number.isInteger(hits) && hits > answers) {
                    hitsInput.setCustomValidity('Acertos deve ser menor ou igual a Respostas.');
                }

                if (!formEl.checkValidity()) {
                    event.preventDefault();
                    formEl.reportValidity();
                }
            });

            updateDifficultyAndValidity();
        }
    </script>

@endsection

@section('scripts')
    <script src="https://unpkg.com/katex@0.12.0/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        // Registrar blot customizado ANTES de inicializar o Quill
        var Embed = Quill.import('blots/embed');
        class KatexFormulaBlot extends Embed {
            static create(value) {
                var node = super.create(value);
                node.innerHTML = katex.renderToString(value, {
                    throwOnError: false
                });
                node.setAttribute('data-latex', value);
                node.setAttribute('contenteditable', 'false');
                return node;
            }
            static value(node) {
                return node.getAttribute('data-latex');
            }
        }
        KatexFormulaBlot.blotName = 'katex-formula';
        KatexFormulaBlot.tagName = 'span';
        KatexFormulaBlot.className = 'ql-katex-formula';
        Quill.register(KatexFormulaBlot);
    </script>
    <script>
        initStatementEditors();
        document.querySelectorAll('form.question-form').forEach(applyDifficultyRules);

        // Reabrir accordion correto após falha de validação server-side
        @php
            $oldQuestionType = old('question_type');
            $accordionMap = [
                'Resposta_Unica'       => 'flush-collapseOne',
                'Resposta_Multipla'    => 'flush-collapseTwo',
                'Afirmacao_Incompleta' => 'flush-collapseThree',
                'Foco_Negativo'       => 'flush-collapseFour',
                'Assercao_Razao'    => 'flush-collapseFive',
                'Associacao_Correspondencia' => 'flush-collapseSix',
                'Lacuna_Completar' => 'flush-collapseSeven',
                'Ordenacao_Seriacao' => 'flush-collapseEight',
                'Interpretacao' => 'flush-collapseNine',
                ];
            $accordionToOpen = $accordionMap[$oldQuestionType] ?? null;
        @endphp
        @if($accordionToOpen)
        document.addEventListener('DOMContentLoaded', function () {
            var collapseEl = document.getElementById('{{ $accordionToOpen }}');
            if (collapseEl) {
                var bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });
                bsCollapse.show();
                collapseEl.addEventListener('shown.bs.collapse', function () {
                    collapseEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, { once: true });
            }
        });
        @endif

        // Preview em tempo real da fórmula
        document.getElementById('formulaLatexInput').addEventListener('input', function() {
            const preview = document.getElementById('formulaPreview');
            if (typeof katex === 'undefined') return;
            try {
                preview.innerHTML = katex.renderToString(this.value, {
                    throwOnError: false,
                    displayMode: true
                });
            } catch (e) {
                preview.innerHTML = '';
            }
        });

        // Inserir fórmula no editor ativo
        document.getElementById('formulaInsertBtn').addEventListener('click', function() {
            const latex = document.getElementById('formulaLatexInput').value.trim();
            if (!latex || !window._activeQuill) return;
            const quill = window._activeQuill;
            const range = quill.getSelection(true);
            const idx = range ? range.index : quill.getLength();
            quill.insertEmbed(idx, 'katex-formula', latex, 'user');
            quill.setSelection(idx + 1, 0, 'user');
            bootstrap.Modal.getInstance(document.getElementById('formulaModal')).hide();
        });
    </script>
@endsection
