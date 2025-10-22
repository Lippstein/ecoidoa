@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Habitat </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('habitats_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>
    <form method="POST" action="{{ route('habitats_create.store') }}"  class="m-4">
        @csrf
        @method('POST')
        <div class="row mb-2">
                <label for="habitat" class="col-sm-2 col-form-label"><strong>Nome do Habitat:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="habitat" name="habitat" value="{{ old('habitat') }}" required autofocus>
                </div>
        </div>

        @php
            $description = old('description', 'Descrição não cadastrada');
            $habitat_url = old('habitat_url', 'URL do Habitat não cadastrada');
            $habitat_owner = old('habitat_owner', 'Proprietário do Habitat não cadastrado');
            $email_owner = old('email_owner', 'Email do Proprietário não cadastrado');
        @endphp

        <div class="row col mb-2">
            <label for="description" class="col-sm-2 col-form-label"><strong>Descrição:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="description" name="description" value="{{ $description }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="habitat_url" class="col-sm-2 col-form-label"><strong>URL:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="habitat_url" name="habitat_url" value="{{ $habitat_url }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="habitat_owner" class="col-sm-2 col-form-label"><strong>Proprietário:</strong>  </label>
            <div class="col">
                <input type="text" class="form-control" id="habitat_owner" name="habitat_owner" value="{{ $habitat_owner }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="email_owner" class="col-sm-2 col-form-label"><strong>Email Proprietário:</strong> </label>
            <div class="col">
                <input type="text" class="form-control" id="email_owner" name="email_owner" value="{{ $email_owner }}" required autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </form>
</div>
@endsection