@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Termo </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show') }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_create.store') }}" class="m-4">
        @csrf
        @method('POST')
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Nome do Termo:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="term" name="term" value="{{ old('term') }}" required autofocus>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="definition" class="col-sm-2 col-form-label"><strong>Definição:</strong></label>
            <div class="col">
                <textarea class="form-control" name="definition" rows="3" autofocus>{{ old('definition') }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label for="language" class="col-sm-2 col-form-label"><strong>Idioma:</strong></label>
            <div class="col">
                    <input type="text" class="form-control" id="language" name="language" value="{{ old('language', 'pt_BR') }}" required autofocus placeholder="pt_BR">
            </div>
        </div> 
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </form>
</div>
@endsection