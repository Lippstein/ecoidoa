@extends("layouts.app")
@section('title', 'Idoa')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script> --}}

@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Excluir Relação de Termo Específico</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('delete_relation.destroy') }}" class="m-4">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="bt_filter" value="{{ request('bt_filter') }}">
        <input type="hidden" name="id_term_bt" value="{{ request('id_term_bt', $id_term_bt ?? '') }}">
        <input type="hidden" name="id_term_nt" value="{{ request('id_term_nt', $id_term_nt ?? '') }}">
        <div class="row mb-2">
            <label for="name_term_bt" class="col-sm-2 col-form-label"><strong>Termo Genérico:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name_term_bt" name="name_term_bt" value="{{ old('name_term_bt', $name_term_bt ?? request('name_term_bt')) }}" readonly>
            </div>
        </div> 
        <div class="row mb-2">
            <label for="name_term_nt" class="col-sm-2 col-form-label"><strong>Termo Específico:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name_term_nt" name="name_term_nt" value="{{ old('name_term_nt', $name_term_nt ?? request('name_term_nt')) }}" readonly>
            </div>
        </div> 
        
        <div class="row mb-3">
            <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>
@endsection