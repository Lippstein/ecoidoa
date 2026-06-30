@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Editar Lista de Documentos do Termo </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => request('niche_filter'), 'bt_filter' => request('bt_filter')]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <form method="POST" action="{{ route('term_docs.update') }}" class="m-4" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="niche_filter" value="{{ request('niche_filter') }}">
        <input type="hidden" name="bt_filter" value="{{ request('bt_filter') }}">
        <input type="hidden" name="id" value="{{ request('id', $term->id ?? '') }}">
        <div class="row mb-2">
            <label for="term" class="col-sm-2 col-form-label"><strong>Termo:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="term" name="term" value="{{ old('term', $term->term ?? '') }}" readonly>
            </div>
        </div>
        <div class="row col mb-2">
            <label for="definition" class="col-sm-2 col-form-label"><strong>Definição:</strong></label>
            <div class="col">
                <textarea required class="form-control" name="definition" rows="3" readonly>{{ old('definition', $term->definition ?? '') }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label for="language" class="col-sm-2 col-form-label"><strong>Idioma:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="language" name="language" value="{{ old('language', 'pt_BR') }}" readonly placeholder="pt_BR">
            </div>
        </div> 
        <div class="row mb-2">
            <label class="col-sm-2 col-form-label"><strong>Novo documento:</strong></label>
            <div class="col">
                <input type="file" name="new_doc" class="form-control" accept=".pdf,.doc,.docx,image/*">
            </div>
        </div>
        <div class="row mb-2">
        <label class="col-sm-2 col-form-label"><strong>Documentos:</strong></label>
            <div class="col">
                <ul>
                    @php
                        $docs = $term->term_data['documents'] ?? []; // pega o array ou vazio
                        $dir = 'niche_' . request('niche_filter'); // Usar o diretório conforme o nicho
                        // $dir = request('niche_filter') . '/docs'; // Usar o diretório conforme o nicho
                    @endphp
                    @if (empty($docs))
                        <li>Nenhum documento incluído.</li>
                    @else
                        @foreach($docs as $doc)
                            <li><button class="btn btn-info btn-sm"><a href="{{ asset('storage/' . $dir . '/' . $doc) }}" target="_blank">{{ $doc }}</a></button>
                                <button type="submit" name="action" value="Excluir_{{ $doc }}" class="btn btn-danger btn-sm">(-) Excluir {{ $doc }}</button>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="row mb-3">
            <button type="submit" value="Incluir" class="btn btn-primary">(+) Incluir Documento</button>
        </div>
    </form>
</div>
@endsection

