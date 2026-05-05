@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Editar Usuário </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('users_create.show') }}" class="btn btn-success">Novo Usuário</a>
        <a href="{{ route('users_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>
    <form method="POST" action="{{ route('users_update.show', $user->id) }}"  class="m-4">
        @csrf
        @method('PUT')
        <div class="row mb-2">
                <label for="name" class="col-sm-1 col-form-label"><strong>Nome:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required autofocus>
                </div>
        </div>
        {{-- Se o nível do usuário for maior ou igual a 7, permitir edição --}}
        @if(Auth::user()->level >= 7)
            <div class="row mb-2">
                <label for="email" class="col-sm-1 col-form-label"><strong>Email:</strong></label>
                <div class="col">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required autofocus>
                </div>  
            </div>
        @else
            <div class="row mb-2">
                <label for="email" class="col-sm-1 col-form-label"><strong>Email:</strong></label>
                <div class="col">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                </div>
            </div>
        @endif
        {{-- Se o nível do usuário for menor que 9, permitir edição --}}        
        @if($user->level < 9)
            <div class="row mb-2">
                <label for="level" class="col-sm-1 col-form-label"><strong>Acesso:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="level" name="level" value="{{ $user->level }}" required autofocus>
                </div>
            </div>
        @else
            <div class="row mb-2">
                <label for="level" class="col-sm-1 col-form-label"><strong>Acesso:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="level" name="level" value="{{ $user->level }}" readonly>
                </div>
            </div>
        @endif
        <div class="py-2 mb-4 rounded">
            <h6 class="text-center">Editar Endereço e Contatos do Usuário</h6>
            <hr style="margin:8px 0; opacity:.3;">
        </div>        
        @php
            $data = $user->address_data;

            // Se for string, tenta decodificar e checar erro explícito
            if (is_string($data)) {
                // tratar string vazia como nula
                if ($data === '') {
                    $data = [];
                } else {
                    $decoded = json_decode($data, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $data = $decoded;
                    } else {
                        // opcional: log do erro para diagnóstico
                        \Log::warning('Falha ao decodificar JSON em address_data', [
                            'user_id' => $user->id ?? null,
                            'json_error' => json_last_error_msg(),
                            'raw' => \Illuminate\Support\Str::limit($data, 200),
                        ]);
                        $data = [];
                    }
                }
            }

            // Se for null ou outro tipo, normalize para array
            if (!is_array($data)) {
                $data = [];
            }

            $street = isset($data['street']) ? $data['street'] : 'Rua não cadastrada';
            $number = isset($data['number']) ? $data['number'] : 'Número não cadastrado';
            $city = isset($data['city']) ? $data['city'] : 'Cidade não cadastrada';
            $state = isset($data['state']) ? $data['state'] : 'Estado não cadastrado';
            $zip = isset($data['zip']) ? $data['zip'] : 'CEP não cadastrado';
            $country = isset($data['country']) ? $data['country'] : 'Brasil';
            $cellphone = isset($data['cellphone']) ? $data['cellphone'] : 'Celular não cadastrado';
            $phone = isset($data['phone']) ? $data['phone'] : 'Telefone não cadastrado';
            $whatsapp = isset($data['whatsapp']) ? $data['whatsapp'] : 'WhatsApp não cadastrado';
            $telegram = isset($data['telegram']) ? $data['telegram'] : 'Telegram não cadastrado';
            $facebook = isset($data['facebook']) ? $data['facebook'] : 'Facebook não cadastrado';
            $instagram = isset($data['instagram']) ? $data['instagram'] : 'Instagram não cadastrado';
            
            $street = old('street', $street);
            $number = old('number', $number);
            $city = old('city', $city);
            $state = old('state', $state);
            $zip = old('zip', $zip);
            $country = old('country', $country);
            $cellphone = old('cellphone', $cellphone);
            $phone = old('phone', $phone);
            $whatsapp = old('whatsapp', $whatsapp);
            $telegram = old('telegram', $telegram);
            $facebook = old('facebook', $facebook);
            $instagram = old('instagram', $instagram);

        @endphp
        {{-- {{ $street }}, {{ $number }} - {{ $city }} - {{ $state }} - {{ $zip }} - {{ $country }} --}}

        <div class="row mb-2">
                <label for="street" class="col-sm-1 col-form-label"><strong>Rua:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="street" name="street" value="{{ $street }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
                <label for="number" class="col-sm-1 col-form-label"><strong>Número:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="number" name="number" value="{{ $number }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
                <label for="city" class="col-sm-1 col-form-label"><strong>Cidade:</strong>  </label>
                <div class="col">
                    <input type="text" class="form-control" id="city" name="city" value="{{ $city }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
                <label for="state" class="col-sm-1 col-form-label"><strong>Estado:</strong> </label>
                <div class="col">
                    <input type="text" class="form-control" id="state" name="state" value="{{ $state }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
                <label for="zip" class="col-sm-1 col-form-label"><strong>CEP:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="zip" name="zip" value="{{ $zip }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
                <label for="country" class="col-sm-1 col-form-label"><strong>País:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="country" name="country" value="{{ $country }}" required autofocus>
                </div>
        </div>
        <div class="row mb-2">
            <label for="cellphone" class="col-sm-1 col-form-label"><strong>Celular:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ $cellphone }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="phone" class="col-sm-1 col-form-label"><strong>Telefone:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $phone }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="whatsapp" class="col-sm-1 col-form-label"><strong>WhatsApp:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $whatsapp }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="telegram" class="col-sm-1 col-form-label"><strong>Telegram:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="telegram" name="telegram" value="{{ $telegram }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="facebook" class="col-sm-1 col-form-label"><strong>Facebook:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $facebook }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="instagram" class="col-sm-1 col-form-label"><strong>Instagram:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $instagram }}" required autofocus>
            </div>
        </div>
        <div class="py-2 mb-4 rounded">
            <h6 class="text-center">Editar Documentos do Usuário</h6>
            <hr style="margin:8px 0; opacity:.3;">
        </div>
        @php

            $dataDoc = $user->document_data;

            // Se for string, tenta decodificar e checar erro explícito
            if (is_string($dataDoc)) {
                // tratar string vazia como nula
                if ($dataDoc === '') {
                    $dataDoc = [];
                } else {
                    $decoded = json_decode($dataDoc, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $dataDoc = $decoded;
                    } else {
                        // opcional: log do erro para diagnóstico
                        \Log::warning('Falha ao decodificar JSON em document_data', [
                            'user_id' => $user->id ?? null,
                            'json_error' => json_last_error_msg(),
                            'raw' => \Illuminate\Support\Str::limit($dataDoc, 200),
                        ]);
                        $dataDoc = [];
                    }
                }
            }

            // Se for null ou outro tipo, normalize para array
            if (!is_array($dataDoc)) {
                $dataDoc = [];
            }

            $type = isset($dataDoc['type']) ? $dataDoc['type'] : 'Tipo de documento não cadastrado';
            $doc_number = isset($dataDoc['doc_number']) ? $dataDoc['doc_number'] : 'Número de documento não cadastrado';
            $issuer = isset($dataDoc['issuer']) ? $dataDoc['issuer'] : 'Órgão emissor não cadastrado';
            $birth = isset($dataDoc['birth']) ? $dataDoc['birth'] : 'Data de nascimento não cadastrada';
            $birthplace = isset($dataDoc['birthplace']) ? $dataDoc['birthplace'] : 'Local de nascimento não cadastrado';
            $nationality = isset($dataDoc['nationality']) ? $dataDoc['nationality'] : 'Nacionalidade não cadastrada';
            $issue_date = isset($dataDoc['issue_date']) ? $dataDoc['issue_date'] : 'Data de emissão não cadastrada';
            $valid_to = isset($dataDoc['valid_to']) ? $dataDoc['valid_to'] : 'Data de fim de validade não cadastrada';
            $cnh = isset($dataDoc['cnh']) ? $dataDoc['cnh'] : 'CNH não cadastrada';
            $rg = isset($dataDoc['rg']) ? $dataDoc['rg'] : 'RG não cadastrado';
            $cpf = isset($dataDoc['cpf']) ? $dataDoc['cpf'] : 'CPF não cadastrado';
            $workcard = isset($dataDoc['workcard']) ? $dataDoc['workcard'] : 'Carteira de trabalho não cadastrada';
            $election = isset($dataDoc['election']) ? $dataDoc['election'] : 'Título de eleitor não cadastrado';
            $passport = isset($dataDoc['passport']) ? $dataDoc['passport'] : 'Passaporte não cadastrado';  
            $mother = isset($dataDoc['mother']) ? $dataDoc['mother'] : 'Nome da mãe não cadastrado';
            $father = isset($dataDoc['father']) ? $dataDoc['father'] : 'Nome do pai não cadastrado';
            $marital = isset($dataDoc['marital']) ? $dataDoc['marital'] : 'Estado civil não cadastrado';
            $profession = isset($dataDoc['profession']) ? $dataDoc['profession'] : 'Profissão não cadastrada';
            $gender = isset($dataDoc['gender']) ? $dataDoc['gender'] : 'Sexo não cadastrado';

            $type = old('type', $type);
            $doc_number = old('doc_number', $doc_number);
            $issuer = old('issuer', $issuer);
            $birth = old('birth', $birth);
            $birthplace = old('birthplace', $birthplace);
            $nationality = old('nationality', $nationality);
            $issue_date = old('issue_date', $issue_date);
            $valid_to = old('valid_to', $valid_to);
            $cnh = old('cnh', $cnh);
            $rg = old('rg', $rg);
            $cpf = old('cpf', $cpf);
            $workcard = old('workcard', $workcard);
            $election = old('election', $election);
            $passport = old('passport', $passport);
            $mother = old('mother', $mother);
            $father = old('father', $father);
            $marital = old('marital', $marital);
            $profession = old('profession', $profession);
            $gender = old('gender', $gender);
        @endphp
        <div class="row mb-2">
            <label for="type" class="col-sm-2 col-form-label"><strong>Tipo de Documento:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="type" name="type" value="{{ $type }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="doc_number" class="col-sm-2 col-form-label"><strong>Núm. Documento:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="doc_number" name="doc_number" value="{{ $doc_number }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="issuer" class="col-sm-2 col-form-label"><strong>Órgão Emissor:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="issuer" name="issuer" value="{{ $issuer }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="birth" class="col-sm-2 col-form-label"><strong>Data Nascimento:</strong></label>
            <div class="col">
                <input type="date" class="form-control" id="birth" name="birth" value="{{ $birth }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="birthplace" class="col-sm-2 col-form-label"><strong>Local Nascimento:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="birthplace" name="birthplace" value="{{ $birthplace }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="nationality" class="col-sm-2 col-form-label"><strong>Nacionalidade:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $nationality }}" required autofocus>
            </div>
        </div>  
        <div class="row mb-2">
            <label for="issue_date" class="col-sm-2 col-form-label"><strong>Data de Emissão:</strong></label>
            <div class="col">
                <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ $issue_date }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="valid_to" class="col-sm-2 col-form-label"><strong>Validade:</strong></label>
            <div class="col">
                <input type="date" class="form-control" id="valid_to" name="valid_to" value="{{ $valid_to }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="cnh" class="col-sm-2 col-form-label"><strong>CNH:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cnh" name="cnh" value="{{ $cnh }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="rg" class="col-sm-2 col-form-label"><strong>RG:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="rg" name="rg" value="{{ $rg }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="cpf" class="col-sm-2 col-form-label"><strong>CPF:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $cpf }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="workcard" class="col-sm-2 col-form-label"><strong>Cart. Trabalho:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="workcard" name="workcard" value="{{ $workcard }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="election" class="col-sm-2 col-form-label"><strong>Título de Eleitor:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="election" name="election" value="{{ $election }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="passport" class="col-sm-2 col-form-label"><strong>Passaporte:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="passport" name="passport" value="{{ $passport }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="mother" class="col-sm-2 col-form-label"><strong>Nome da Mãe:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="mother" name="mother" value="{{ $mother }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="father" class="col-sm-2 col-form-label"><strong>Nome do Pai:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="father" name="father" value="{{ $father }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="marital" class="col-sm-2 col-form-label"><strong>Estado Civil:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="marital" name="marital" value="{{ $marital }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="profession" class="col-sm-2 col-form-label"><strong>Profissão:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="profession" name="profession" value="{{ $profession }}" required autofocus>
            </div>
        </div>
        <div class="row mb-2">
            <label for="gender" class="col-sm-2 col-form-label"><strong>Gênero:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $gender }}" required autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>
@endsection