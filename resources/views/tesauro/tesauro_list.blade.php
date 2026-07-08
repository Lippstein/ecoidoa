@extends('layouts.app')
@section('content')
    <div class="container">
        @php
            $nome = 'Todos';
            foreach($niches as $niche) {
                if ($niche_filter == $niche->id) {
                    $nomeNicho = $niche->niche;
                    break;
                }
            }
        @endphp
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Termos do Nicho: {{ $niche_filter }} - {{ $nomeNicho ?? 'Todos' }} - {{ $bt_filter }}</h4>
        </div>

        @if($tesauro->isEmpty())
            @php
                $tabNiches = \App\Models\Niche::where('id', $niche_filter)->first(); 
                $tabHabitats = \App\Models\Habitat::where('id', $tabNiches->habitat_id)->first();
                $tabRelations = \App\Models\Relation::where('id_niche', $niche_filter)->get();

                $nameDoBT = $tabHabitats->habitat;
                $tabTerms = \App\Models\Term::where('term', $nameDoBT)
                    ->where('id_niche', $niche_filter)
                    ->get();
                if($tabTerms->isEmpty()) {
                    \App\Models\Term::firstOrCreate(
                        ['term' => $nameDoBT, 'id_niche' => $niche_filter],
                        ['definition' => 'Termo Genérico (raiz ou inicial) deste nicho', 'language' => 'pt_BR']
                    );
                    // atualizar as variáveis para refletir os termos recém-criados
                    $tabTerms = \App\Models\Term::where('id_niche', $niche_filter)->get();
                }
                $idTermBT = null;
                foreach ($tabTerms as $i) {
                    if (isset($i->id) && strcasecmp($i->term, $nameDoBT) === 0) {
                        $idTermBT = $i->id;
                        break;
                    }
                }

                $nameDoNT = $tabNiches->niche;
                $tabTerms = \App\Models\Term::where('term', $nameDoNT)
                    ->where('id_niche', $niche_filter)
                    ->get();
                if($tabTerms->isEmpty()) {
                    \App\Models\Term::firstOrCreate(
                    ['term' => $nameDoNT, 'id_niche' => $niche_filter],
                    ['definition' => 'Primeiro termo específico deste nicho', 'language' => 'pt_BR']
                    );
                    // atualizar as variáveis para refletir os termos recém-criados
                    $tabTerms = \App\Models\Term::where('id_niche', $niche_filter)->get();
                }
                $idTermNT = null;
                foreach ($tabTerms as $i) {
                    if (isset($i->id) && strcasecmp($i->term, $nameDoNT) === 0) {
                        $idTermNT = $i->id;
                        break;
                    }
                }
                $bt_filter = $idTermBT;
                $id_term_bt = $idTermBT;
                $id_term_nt = $idTermNT;
                
                // dd($idTermBT, $idTermNT);

                if($tabRelations->isEmpty()) {
                    \App\Models\Relation::firstOrCreate(
                        [
                            'id_niche' => $niche_filter,
                            'id_term_bt' => $idTermBT,
                            'id_term_nt' => $idTermNT,
                            'id_user' => auth()->id(),
                        ],
                        ['term_order' => 1]
                    );
                    echo "<script>window.location.href='" . route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $tabNiches->id]) . "';</script>";
                    exit;
                }

            @endphp
            {{-- <script> --}}
                // garante escape seguro para JS
                // window.location.href = @json($redirectUrl);
            {{-- </script> --}}
        @else
            <div class="flex items-end w-rounded">
                <form method="GET" action="{{ route('tesauro_list.show') }}" class="row row-cols-lg-auto mb-2 g-2 align-items-center">
                    @csrf
                    <input type="hidden" name="niche_filter" id="niche_filter" value="{{ old('niche_filter', $niche_filter ?? request('niche_filter')) }}">
                    <input type="hidden" name="bt_filter" id="bt_filter" value="{{ old('bt_filter', $bt_filter ?? request('bt_filter')) }}">
                    <div class="col-12">
                        <select class="form-select" name="niche_filter" id="niche_filter" required style="width: 20ch;">
                            <option value="0">Escolha um nicho</option>
                            @foreach($niches as $niche)
                                @if ($niche_filter==$niche->id)
                                    <option value="{{ $niche->id }}" selected>{{ $niche->niche }}</option>
                                @else
                                    <option value="{{ $niche->id }}">{{ $niche->niche }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                     <div class="col-12">
                        <button type="submit" class="btn btn-secondary">Filtrar Nicho</button>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <select class="form-select" style="width: 300px;" name="bt_filter" id="bt_filter" required>
                            <option value="0">Escolha um BT</option>
                            @php
                                function nextTermOrder($id_termo_bt, $children, $termOrder) {
                                    $filteredChildren = [];
                                    if(isset($children[$id_termo_bt])) {
                                        $filteredChildren[$id_termo_bt] = $children[$id_termo_bt];
                                    }
                                    $maxOrder = $termOrder;
                                    if (!empty($filteredChildren[$id_termo_bt])) {
                                        foreach ($filteredChildren[$id_termo_bt] as $filho) {
                                            if ($filho['term_order'] >= $maxOrder) {
                                                $maxOrder = $filho['term_order'] + 1;
                                            }
                                        }
                                    } else {
                                        $maxOrder = $termOrder . '1';
                                    }
                                    return $maxOrder;
                                }

                                $relations = \App\Models\Relation::where('id_niche', $niche_filter)
                                    ->orderBy('term_order')
                                    ->get()
                                    ->toArray();

                                $termsNames = \App\Models\Term::where('id_niche', $niche_filter)
                                    ->get()
                                    ->keyBy('id'); // Cria índice [id] => objeto Term

                                // btsUnicos usado para montar a lista de opções do select de BT, garantindo que cada BT apareça apenas uma vez, mesmo que tenha múltiplos NTs relacionados
                                $btsUnicos = \App\Models\Relation::where('id_niche', $niche_filter)
                                    ->orderBy('term_order')           // garante qual ocorrência vem primeiro
                                    ->get()
                                    ->unique('id_term_bt')            // remove duplicados mantendo a primeira
                                    ->values()                        // reindexa os índices
                                    ->toArray();

                                //children é um array auxiliar para organizar as relações BT -> [NTs], facilitando a construção da árvore hierárquica e o cálculo do próximo term_order
                                $children = [];
                                foreach ($relations as $rel) {
                                    if (!isset($termsNames[$rel['id_term_nt']])) {
                                        continue; // Ignora relacoes cujo NT nao existe no nicho atual
                                    }
                                    $children[$rel['id_term_bt']][] = [
                                        'id_term_nt' => $rel['id_term_nt'],
                                        'term_order' => $rel['term_order'],
                                    ];
                                }
                                foreach($btsUnicos as $bt) {
                                    $termId = $bt['id_term_bt'];
                                    $termName = $termsNames[$termId]->term ?? '(termo nao encontrado).' . $termId;
                                    if ($termId == $bt_filter) {
                                        echo '<option value="'. $termId .'" selected>' .  $termName  . '</option>';
                                    } else {
                                        echo '<option value="' .  $termId . '">' .  $termName  . '</option>';
                                    }   
                                }

                                $selectedTermId = ($bt_filter !== null && (int) $bt_filter !== 0)
                                    ? (int) $bt_filter
                                    : $termsNames->keys()->first();
                                $auxnt = $selectedTermId;
                                $auxnt1 = $selectedTermId && isset($termsNames[$selectedTermId])
                                    ? $termsNames[$selectedTermId]->term
                                    : '';
                                $termOrder = 0;
                                $nextOrder = $selectedTermId
                                    ? nextTermOrder($selectedTermId, $children, $termOrder)
                                    : 0;
                            @endphp
                        </select>
                    </div>
                     <div class="col-12">
                        <button type="submit" class="btn btn-secondary">Filtrar BT</button>
                    </div>

                    <div class="col-12">
                        <a href="{{ route('term_create.show', [
                        'niche_filter' => $niche_filter, 
                           'bt_filter' => $bt_filter,
                           'id_term_bt' => $auxnt,
                           'name_term_bt' => $auxnt1,
                           'term_order' => $nextOrder,
                           'soTermo' => 'soTermo'
                          ]) }}" 
                          class="btn btn-success">Novo Termo</a>
                    </div>
                </form>

                @php
                // $nicheLevel para verificar se o usuário tem permissão para alterar o tesauro
                    $nicheLevel = 0;
                    $tabUsersDataFlex = \App\Models\UsersDataFlex::where('niche_level', (int) $niche_filter)
                        ->where('user_id', (int) auth()->id())
                        ->first();
                    if ($tabUsersDataFlex) {
                        $nicheLevel = $tabUsersDataFlex->niche_level ?? 0;
                    }
                    // dd($tabUsersDataFlex, $nicheLevel);
                    // Função recursiva para listar a árvore
                    function listarTermosRecursivos($id_termo_bt, $children, $termsNames, $niche_filter, $bt_filter, $nivel = 0, $nicheLevel) {
                        if (!isset($children[$id_termo_bt])) return;
                        foreach ($children[$id_termo_bt] as $filho) {
                            $name = isset($termsNames[$filho['id_term_nt']]) ? $termsNames[$filho['id_term_nt']]->term : "(termo não encontrado gggggggg)";
                            $definition = isset($termsNames[$filho['id_term_nt']]) ? $termsNames[$filho['id_term_nt']]->definition : "(definição não encontrada)";
                            $termOrder = $filho['term_order'];
                            $id_termo_nt = $filho['id_term_nt'];
                            $nextOrder = nextTermOrder($id_termo_nt, $children, $termOrder);
                            if ($nicheLevel > 0) {
                                $editUrl = route('term_edit.show', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                            'id' => $filho['id_term_nt']
                                    ]);
                                $docsUrl = route('term_docs.show', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                            'id' => $filho['id_term_nt']
                                    ]);
                                $insTermUrl = route('term_create.show', [
                                    'niche_filter' => $niche_filter, 
                                    'id_term_bt' => $filho['id_term_nt'], 
                                    'name_term_bt' => $name, 
                                    'term_order' => $nextOrder, 
                                    'bt_filter' => $bt_filter
                                    ]);
                                $insNTUrl = route('term_creatent.show', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                    'id_term_bt' => $filho['id_term_nt'], 
                                    'name_term_bt' => $name, 
                                    'term_order' => $nextOrder
                                    ]);
                                $questionsUrl = route('term_questions.create', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                            'id' => $filho['id_term_nt'],
                                    'term_order' => $nextOrder
                                    ]);
                                $rateiosUrl = route('term_rateios.create', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                            'id' => $filho['id_term_nt'],
                                    'term_order' => $nextOrder
                                    ]);
                                $nameBT = isset($termsNames[$id_termo_bt]) ? $termsNames[$id_termo_bt]->term : "(termo não encontrado hhhhh)";
                                $delNTUrl = route('delete_relation.show', [
                                    'niche_filter' => $niche_filter, 
                                    'bt_filter' => $bt_filter, 
                                    'id_term_bt' => $id_termo_bt, 
                                    'name_term_bt' => $nameBT, 
                                    'id_term_nt' => $id_termo_nt, 
                                    'name_term_nt' => $name
                                    ]);
                                $ordenarUrl = route('tesauro.children', [
                                    'id_term_bt' => $id_termo_nt,
                                    'id_niche' => $niche_filter,
                                    'niche_filter' => $niche_filter,
                                    'bt_filter' => $bt_filter
                                ]);
                            } else {
                                $editUrl = '#';
                                $docsUrl = '#';
                                $insTermUrl = '#';
                                $insNTUrl = '#';
                                $questionsUrl = '#';
                                $rateiosUrl = '#';
                                $delNTUrl = '#';
                                $ordenarUrl = '#';
                            }
                            // dd($nicheLevel, $editUrl);
                            echo '<div class="accordion-item">';
                            echo '    <h2 class="accordion-header">';
                            echo '        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-'.$id_termo_bt.$filho['id_term_nt'].'" aria-expanded="false" aria-controls="flush-'.$id_termo_bt.$filho['id_term_nt'].'">';
                            echo '            ' . str_repeat('&nbsp;', $nivel*4) . $termOrder . " - " . $nextOrder . " - " . $name . " - ID: " . $filho['id_term_nt'] . '&nbsp;';
                            echo '        </button>';
                            echo '    </h2>';
                            echo '    <div id="flush-'.$id_termo_bt.$filho['id_term_nt'].'" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">';
                            echo '        <div class="accordion-body">';
                            echo '            ' . $definition . '<br>';
                            echo '            <a href="' . $editUrl . '" class="link-opacity-75-hover">Editar</a>';
                            echo '            <a href="' . $insTermUrl . '" class="link-opacity-75-hover">Novo</a>';
                            echo '            <a href="' . $insNTUrl . '" class="link-opacity-75-hover">Incluir (NT)</a>';
                            echo '            <a href="' . $delNTUrl . '" class="link-opacity-75-hover">Excluir (NT)</a>';
                            echo '            <a href="' . $ordenarUrl . '" class="link-opacity-75-hover">Ordenar</a>';
                            if ($niche_filter == 1 || $niche_filter == 2) {
                                echo '            <a href="' . $questionsUrl . '" class="link-opacity-75-hover">Questões</a>';
                            } elseif ($niche_filter == 3 || $niche_filter == 4) {
                                echo '            <a href="' . $rateiosUrl . '" class="link-opacity-75-hover">Rateios</a>';
                            }
                            echo '            <a href="' . $docsUrl . '" class="link-opacity-75-hover">Documentos</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                            listarTermosRecursivos($filho['id_term_nt'], $children, $termsNames, $niche_filter, $bt_filter, $nivel+1, $nicheLevel);
                        }
                    }

                    echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
                        // Supondo que $niche_filter seja o termo raiz:
                        $primeiroTermoBt = array_key_first($children);
                        if ($bt_filter !== null or $bt_filter !== 0) {
                            $primeiroTermoBt = $bt_filter;
                        }
                        if ($primeiroTermoBt !== null) {
                            listarTermosRecursivos($primeiroTermoBt, $children, $termsNames, $niche_filter, $bt_filter, 1, $nicheLevel);
                        } else {
                            echo 'Nenhum termo encontrado.';
                        }
                    echo '</div>';
                @endphp
                <div class="flex items-center justify-center w-rounded bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 p-2 rounded mb-4">  
                    @php
                        $pagination = $tesauro->appends(['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->links('pagination::bootstrap-5');
                    @endphp
                    {!! $pagination !!}
                </div>
            </div>
        @endif
    </div>
@endsection
