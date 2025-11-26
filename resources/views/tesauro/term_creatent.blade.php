@extends("layouts.app")
@section('title', 'Idoa')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Termo Específico</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => $niche_filter]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_creatent.store') }}" class="m-4">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="id_term_bt" value="{{ request('id_term_bt', $id_term_bt ?? '') }}">
        <input type="hidden" name="term_order" value="{{ request('term_order', $term_order ?? '0') }}">
        <div class="row mb-2">
            <label for="name_term_bt" class="col-sm-2 col-form-label"><strong>Termo Genérico:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name_term_bt" name="name_term_bt" value="{{ old('name_term_bt', $name_term_bt ?? request('name_term_bt')) }}" readonly>
            </div>
        </div> 
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Termo Específico:</strong></label>
            <div class="col">
                <input type="text" list="termList" id="id_term_nt_text" placeholder="Digite para buscar termo">
                <input type="hidden" name="id_term_nt" id="id_term_nt">
                {{-- <input type="text" list="termList" name="id_term_nt" id="id_term_nt" placeholder="Digite para buscar termo"> --}}
            </div>
        </div>
        {{-- <datalist id="termList" class="mb-2">
            @foreach($terms as $termo)
                <option value="{{ $termo->id }}">{{ $termo->term }}</option>
            @endforeach
        </datalist> --}}
        
        <datalist id="termList">
            @foreach($terms as $termo)
                <option value="{{ $termo->term }}" data-id="{{ $termo->id }}"></option>
            @endforeach
        </datalist>

        <script>
        document.getElementById('id_term_nt_text').addEventListener('change', function() {
            let text = this.value;
            let options = document.querySelectorAll('#termList option');
            let foundId = '';
            options.forEach(opt => {
                if(opt.value === text) {
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