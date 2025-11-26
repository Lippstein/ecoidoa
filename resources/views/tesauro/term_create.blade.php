@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Termo </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => $niche_filter]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_create.store') }}" class="m-4">
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
                <input type="text" class="form-control" id="term" name="term" value="{{ old('term') }}" required autofocus>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="definition" class="col-sm-2 col-form-label"><strong>Definição:</strong></label>
            <div class="col">
                <textarea required class="form-control" name="definition" rows="3" autofocus>{{ old('definition') }} </textarea>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="term_order" class="col-sm-2 col-form-label"><strong>Ordem do Termo:</strong></label>
            <div class="col">
                <input type="number" class="form-control" id="term_order" name="term_order" value="{{ old('term_order', $term_order ?? '0') }}" readonly>
            </div>
        </div>
        <div class="row mb-2">
            <label for="language" class="col-sm-2 col-form-label"><strong>Idioma:</strong></label>
            <div class="col">
                    <input type="text" class="form-control" id="language" name="language" value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
            </div>
        </div> 
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </form>
</div>
@endsection