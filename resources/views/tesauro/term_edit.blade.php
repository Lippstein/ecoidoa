@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Editar Termo </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => request('niche_filter')]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_edit.update') }}" class="m-4">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="id" value="{{ request('id', $term->id ?? '') }}">
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Termo:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="term" name="term" value="{{ old('term', $term->term ?? '') }}" required autofocus>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="definition" class="col-sm-2 col-form-label"><strong>Definição:</strong></label>
            <div class="col">
                <textarea required class="form-control" name="definition" rows="3" autofocus>{{ old('definition', $term->definition ?? '') }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label for="language" class="col-sm-2 col-form-label"><strong>Idioma:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="language" name="language" value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
            </div>
        </div> 
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
    </form>
</div>
@endsection