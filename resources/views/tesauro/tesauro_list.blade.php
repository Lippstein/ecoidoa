@extends('layouts.app')
@section('content')
    <div class="container">
        @php
            // $bt_filter = request('bt_filter') ?? 0;
            $nome = 'Todos';
            foreach($niches as $niche) {
                if ($niche_filter == $niche->id) {
                    $nome = $niche->niche;
                    break;
                }
            }
        @endphp
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Termos do Nicho: {{ $niche_filter }} - {{ $nome }} - {{ $bt_filter }}</h4>
        </div>
        @if($tesauro->isEmpty())

            <script>
                // "{{ route('term_create.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter]) }}";
                window.location.href = route('term_create.show', [
                    'niche_filter' => $niche_filter,
                    'bt_filter' => $bt_filter,
                    'id_term_bt' => $bt_filter,
                ]);
            </script>
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
                                $termsNames = \App\Models\Term::all()->keyBy('id'); // Cria índice [id] => objeto Term
                                $relations = \App\Models\Relation::orderBy('id_term_bt')->get();
                                $uniqueRelations = $relations->unique('id_term_bt')->values()->toArray();

                                // $relations = \App\Models\Relation::orderBy('id_term_bt')->get()->toArray();
                                foreach ($uniqueRelations as $rel) {
                                    if ($rel['id_niche'] != $niche_filter) {
                                        continue; // Pula relações que não pertencem ao nicho filtrado
                                    }
                                    $aux = $rel['id_term_bt'];
                                    $aux1 = $termsNames[$aux]->term ?? '(termo não encontrado)';
                                    if ($rel['id_term_bt'] == $bt_filter) {
                                        echo '<option value="'. $aux .'" selected>' .  $aux1  . '</option>';
                                    } else {
                                        echo '<option value="' .  $aux . '">' .  $aux1  . '</option>';
                                    }
                                }
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
                          'id_term_bt' => $bt_filter,
                        ]) }}" class="btn btn-success">Novo Termo</a>
                    </div>
                </form>

                @php
                    $termsNames = \App\Models\Term::all()->keyBy('id'); // Cria índice [id] => objeto Term
                    $relations = \App\Models\Relation::orderBy('term_order')->get()->toArray();
                    $children = [];
                    foreach ($relations as $rel) {
                        if ($rel['id_niche'] != $niche_filter) {
                            continue; // Pula relações que não pertencem ao nicho filtrado
                        }
                        // $children[$rel['id_term_bt']][] = $rel['id_term_nt'];
                        $children[$rel['id_term_bt']][] = [
                            'id_term_nt' => $rel['id_term_nt'],
                            'term_order' => $rel['term_order'],
                        ];
                   }

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

                    // Função recursiva para listar a árvore
                    function listarTermosRecursivos($id_termo_bt, $children, $termsNames, $niche_filter, $bt_filter, $nivel = 0) {
                        if (!isset($children[$id_termo_bt])) return;
                        foreach ($children[$id_termo_bt] as $filho) {
                            $name = isset($termsNames[$filho['id_term_nt']]) ? $termsNames[$filho['id_term_nt']]->term : "(termo não encontrado)";
                            $definition = isset($termsNames[$filho['id_term_nt']]) ? $termsNames[$filho['id_term_nt']]->definition : "(definição não encontrada)";
                            $termOrder = $filho['term_order'];
                            $id_termo_nt = $filho['id_term_nt'];
                            $nextOrder = nextTermOrder($id_termo_nt, $children, $termOrder);
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
                            $nameBT = isset($termsNames[$id_termo_bt]) ? $termsNames[$id_termo_bt]->term : "(termo não encontrado)";
                            $delNTUrl = route('delete_relation.show', [
                                'niche_filter' => $niche_filter, 
                                   'bt_filter' => $bt_filter, 
                                  'id_term_bt' => $id_termo_bt, 
                                'name_term_bt' => $nameBT, 
                                  'id_term_nt' => $id_termo_nt, 
                                'name_term_nt' => $name
                            ]);
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
                            echo '            <a href="' . route('tesauro.children', ['id_term_bt' => $id_termo_nt, 'id_niche' => $niche_filter, 'niche_filter' => $niche_filter, 'bt_filter' => $bt_filter]) . '" class="link-opacity-75-hover">Ordenar</a>';
                            echo '            <a href="' . $docsUrl . '" class="link-opacity-75-hover">Documentos</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                            listarTermosRecursivos($filho['id_term_nt'], $children, $termsNames, $niche_filter, $bt_filter, $nivel+1);
                        }
                    }

                    echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
                        // Supondo que $niche_filter seja o termo raiz:
                        $primeiroTermoBt = array_key_first($children);
                        if ($bt_filter !== null or $bt_filter !== 0) {
                            $primeiroTermoBt = $bt_filter;
                        }
                        if ($primeiroTermoBt !== null) {
                            listarTermosRecursivos($primeiroTermoBt, $children, $termsNames, $niche_filter, $bt_filter, 1);
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
@endsection
