@extends('layouts.app')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Visualizar Habitat </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('habitats_create.show') }}" class="btn btn-success">Novo Habitat</a>
        <a href="{{ route('habitats_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>

    <div class="row mb-2">
        <strong>Nome do Habitat:</strong>
        <div>
             {{ $habitat->habitat }}
        </div>
        <strong>Data de Cadastro:</strong>
        <div>
            {{ \Carbon\Carbon::parse($habitat->created_at)->format('d/m/Y H:i:s') }}
             {{-- {{ $habitat->created_at }} --}}
        </div>
        <strong>Atualizado em:</strong>
        <div>
            {{ \Carbon\Carbon::parse($habitat->updated_at)->format('d/m/Y H:i:s') }}
        </div>
    </div>
    @php
        $data = $habitat->habitat_data;
        if (is_string($data)) {
            try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
        }
        $description = isset($data['description']) ? $data['description'] : 'Descrição não cadastrada';
        $habitat_url = isset($data['habitat_url']) ? $data['habitat_url'] : 'URL do Habitat não cadastrada';
        $habitat_owner = isset($data['habitat_owner']) ? $data['habitat_owner'] : 'Proprietário do Habitat não cadastrado';
        $email_owner = isset($data['email_owner']) ? $data['email_owner'] : 'Email do Proprietário não cadastrado';
    @endphp
    <div class="py-2 mb-4 rounded">
        <h6 class="text-center">Detalhes do Habitat</h6>
        <hr style="margin:8px 0; opacity:.3;">
    </div>
    <div class="row mb-2">
        <strong>Descrição:</strong>
        <div>
            {{ $description }}
        </div>
        <strong>URL do Habitat:</strong>
        <div>
            {{ $habitat_url }}
        </div>
        <strong>Proprietário do Habitat:</strong>
        <div>
            {{ $habitat_owner }}
        </div>
        <strong>Email do Proprietário:</strong>
        <div>
            {{ $email_owner }}
        </div>
    </div>
</div>
@endsection