@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Cadastrar Nicho </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('niches_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>
    <form method="POST" action="{{ route('niches_create.store') }}"  class="m-4">
        @csrf
        @method('POST')

        <div class="row col mb-2">
            <label for="habitat_id" class="col-sm-2 col-form-label"><strong>Habitat:</strong></label>
            <div class="col">
                <select class="form-select" name="habitat_id" id="habitat_id" required>
                    <option value="">Selecione o habitat</option>
                    @foreach($habitats as $habitat)
                        <option value="{{ $habitat->id }}">{{ $habitat->habitat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row col mb-2">
                <label for="niche" class="col-sm-2 col-form-label"><strong>Nome do Nicho:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="niche" name="niche" value="{{ old('niche') }}" required autofocus>
                </div>
        </div>

        @php
            $description = isset($data['description']) ? $data['description'] : 'Descrição não cadastrada';
            $company_name = isset($data['company_name']) ? $data['company_name'] : 'Nome da empresa não cadastrada';
            $trade_name = isset($data['trade_name']) ? $data['trade_name'] : 'Nome fantasia não cadastrado';
            $foundation = isset($data['foundation']) ? $data['foundation'] : 'Fundação não cadastrada';
            $authorization = isset($data['authorization']) ? $data['authorization'] : 'Autorização ou CNPJ não cadastrada';
        @endphp

        <div class="row col mb-2">
            <label for="description" class="col-sm-2 col-form-label"><strong>Descrição:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="description" name="description" value="{{ $description }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="company_name" class="col-sm-2 col-form-label"><strong>Nome da Empresa:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $company_name }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="trade_name" class="col-sm-2 col-form-label"><strong>Nome Fantasia:</strong>  </label>
            <div class="col">
                <input type="text" class="form-control" id="trade_name" name="trade_name" value="{{ $trade_name }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="foundation" class="col-sm-2 col-form-label"><strong>Fundação:</strong> </label>
            <div class="col">
                <input type="text" class="form-control" id="foundation" name="foundation" value="{{ $foundation }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="authorization" class="col-sm-2 col-form-label"><strong>Autorização/CNPJ:</strong> </label>
            <div class="col">
                <input type="text" class="form-control" id="authorization" name="authorization" value="{{ $authorization }}" required autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </form>
</div>
@endsection
