@extends("layouts.app")
@section('title', 'Idoa')

@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Termo Específico</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_creatent.store') }}" class="m-4">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="bt_filter" value="{{ request('bt_filter') }}">
        <input type="hidden" name="id_term_bt" value="{{ request('id_term_bt', $id_term_bt ?? '') }}">
        <input type="hidden" name="term_order" value="{{ request('term_order', $term_order ?? '0') }}">
        @php
            $resolvedIdTermBt = request('id_term_bt', $id_term_bt ?? null);
            $resolvedNameTermBt = optional(\App\Models\Term::find($resolvedIdTermBt))->term;
        @endphp
        <div class="row mb-2">
            <label for="name_term_bt" class="col-sm-2 col-form-label"><strong>Termo Genérico:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name_term_bt" name="name_term_bt" value="{{ old('name_term_bt', $resolvedNameTermBt) }}" readonly>
            </div>
        </div>        
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Termo Específico:</strong></label>
            <div class="col">
                <input type="text" list="termList" id="id_term_nt_text" placeholder="Digite para buscar termo" autofocus>
                <input type="hidden" name="id_term_nt" id="id_term_nt">
            </div>
        </div>
        <script>
            limparDatalist();
            limparCampoTermo();
        </script>

        <datalist id="termList">
            // O loop para preencher o datalist com os termos disponíveis já filtrados pelo controlador
            @foreach($terms as $term)
                <option value="{{ $term->term }}" data-id="{{ $term->id }}"></option>
            @endforeach
        </datalist>

        <script>
            function limparDatalist() {
                const datalist = document.getElementById('termList');
                datalist.innerHTML = '';
            }

            function limparCampoTermo() {
                document.getElementById('id_term_nt_text').value = '';
                document.getElementById('id_term_nt').value = '';
            }

            document.getElementById('id_term_nt_text').addEventListener('change', function() {
                let text = this.value;
                let options = document.querySelectorAll('#termList option');
                let foundId = '';

                options.forEach(opt => {
                    if (opt.value === text) {
                        foundId = opt.getAttribute('data-id');
                    }
                });

                document.getElementById('id_term_nt').value = foundId;
            });
        </script>

        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </form>
</div>
@endsection