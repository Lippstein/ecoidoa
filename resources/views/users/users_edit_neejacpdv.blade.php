@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">

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

        $type = isset($dataDoc['type']) ? $dataDoc['type'] : 'Indefinido';
        $social_name = isset($dataDoc['social_name']) ? $dataDoc['social_name'] : '';
        $doc_number = isset($dataDoc['doc_number']) ? $dataDoc['doc_number'] : 'Nao cadastrado';
        $issuer = isset($dataDoc['issuer']) ? $dataDoc['issuer'] : 'Nao cadastrado';
        $birth = isset($dataDoc['birth']) ? $dataDoc['birth'] : 'Nao cadastrada';
        $birthplace = isset($dataDoc['birthplace']) ? $dataDoc['birthplace'] : 'Nao cadastrado';
        $nationality = isset($dataDoc['nationality']) ? $dataDoc['nationality'] : 'Nao cadastrada';
        $issue_date = isset($dataDoc['issue_date']) ? $dataDoc['issue_date'] : 'Nao cadastrada';
        $valid_to = isset($dataDoc['valid_to']) ? $dataDoc['valid_to'] : 'Indeterminada';
        $mother = isset($dataDoc['mother']) ? $dataDoc['mother'] : 'Nao cadastrado';
        $father = isset($dataDoc['father']) ? $dataDoc['father'] : 'Nao cadastrado';
        $cnh = isset($dataDoc['cnh']) ? $dataDoc['cnh'] : 'Nao cadastrado';
        $rg = isset($dataDoc['rg']) ? $dataDoc['rg'] : 'Nao cadastrado';
        $cpf = isset($dataDoc['cpf']) ? $dataDoc['cpf'] : 'Nao cadastrado';
        $race = isset($dataDoc['race']) ? $dataDoc['race'] : 'Indefinida';
        $workcard = isset($dataDoc['workcard']) ? $dataDoc['workcard'] : 'Nao cadastrada';
        $election = isset($dataDoc['election']) ? $dataDoc['election'] : 'Nao cadastrado';
        $passport = isset($dataDoc['passport']) ? $dataDoc['passport'] : 'Nao cadastrado';  
        $marital = isset($dataDoc['marital']) ? $dataDoc['marital'] : 'Nao cadastrado';
        $profession = isset($dataDoc['profession']) ? $dataDoc['profession'] : 'Nao cadastrada';
        $gender_identity = isset($dataDoc['gender_identity']) ? $dataDoc['gender_identity'] : 'Nao cadastrada';
        $biological_sex = isset($dataDoc['biological_sex']) ? $dataDoc['biological_sex'] : 'Nao cadastrado';
        $profile_image = isset($dataDoc['profile_image']) ? $dataDoc['profile_image'] : 'Fazer upload';
        $profile_document = isset($dataDoc['profile_document']) ? $dataDoc['profile_document'] : 'Fazer upload';
        $proof_of_schooling = isset($dataDoc['proof_of_schooling']) ? $dataDoc['proof_of_schooling'] : 'Fazer upload';
        $proof_of_residence = isset($dataDoc['proof_of_residence']) ? $dataDoc['proof_of_residence'] : 'Fazer upload';

        $type = old('type', $type);
        $social_name = old('social_name', $social_name);
        $doc_number = old('doc_number', $doc_number);
        $issuer = old('issuer', $issuer);
        $birth = old('birth', $birth);
        $birthplace = old('birthplace', $birthplace);
        $nationality = old('nationality', $nationality);
        $issue_date = old('issue_date', $issue_date);
        $valid_to = old('valid_to', $valid_to);
        $mother = old('mother', $mother);
        $father = old('father', $father);
        $cnh = old('cnh', $cnh);
        $rg = old('rg', $rg);
        $cpf = old('cpf', $cpf);
        $race = old('race', $race);
        $workcard = old('workcard', $workcard);
        $election = old('election', $election);
        $passport = old('passport', $passport);
        $marital = old('marital', $marital);
        $profession = old('profession', $profession);
        $gender_identity = old('gender_identity', $gender_identity);
        $marital = old('marital', $marital);
        $profession = old('profession', $profession);
        $gender_identity = old('gender_identity', $gender_identity);
        $biological_sex = old('biological_sex', $biological_sex);
        $profile_image = old('profile_image', $profile_image);
        $profile_document = old('profile_document', $profile_document);
        $proof_of_schooling = old('proof_of_schooling', $proof_of_schooling);
        $proof_of_residence = old('proof_of_residence', $proof_of_residence);


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
        $street = isset($data['street']) ? $data['street'] : 'Rua/Avenida/... não cadastrada';
        $number = isset($data['number']) ? $data['number'] : 'Número não cadastrado';
        $city = isset($data['city']) ? $data['city'] : 'Cidade não cadastrada';
        $state = isset($data['state']) ? $data['state'] : 'Estado não cadastrado';
        $neighborhood_user = isset($data['neighborhood_user']) ? $data['neighborhood_user'] : 'Bairro não cadastrado';
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
        $neighborhood_user = old('neighborhood_user', $neighborhood_user);
        $zip = old('zip', $zip);
        $country = old('country', $country);
        $cellphone = old('cellphone', $cellphone);
        $phone = old('phone', $phone);
        $whatsapp = old('whatsapp', $whatsapp);
        $telegram = old('telegram', $telegram);
        $facebook = old('facebook', $facebook);
        $instagram = old('instagram', $instagram);


        // ******************************************************
        $nicheId = $niche_id ?? request()->route('niche_id');
        $userDataFlex = null;
        if (!empty($nicheId)) {
            $userDataFlex = \App\Models\UsersDataFlex::where('user_id', $user->id)
                ->where('niche_id', $nicheId)
                ->first();
        }
        $userProfile = $userDataFlex->user_profile ?? [];

        // Se for string, tenta decodificar e checar erro explícito
        if (is_string($userProfile)) {
            // tratar string vazia como nula
            if ($userProfile === '') {
                $userProfile = [];
            } else {
                $decoded = json_decode($userProfile, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $userProfile = $decoded;
                } else {
                    // opcional: log do erro para diagnóstico
                    \Log::warning('Falha ao decodificar JSON em user_profile', [
                        'user_id' => $user->id ?? null,
                        'json_error' => json_last_error_msg(),
                        'raw' => \Illuminate\Support\Str::limit($userProfile, 200),
                    ]);
                    $userProfile = [];
                }
            }
        }

        // Se for null ou outro tipo, normalize para array
        if (!is_array($userProfile)) {
            $userProfile = [];
        }

        $iseNumber = isset($dataDoc['iseNumber']) ? $dataDoc['iseNumber'] : '0';
        $iseNumber = old('iseNumber', $iseNumber);

        // $profile = \App\Models\UsersDataFlex::select('id')
        //     ->where('user_id', $user->id)
        //     ->where('niche_id', $nicheId)
        //     ->first();

    @endphp

    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">CENTRAL DE MATRÍCULA - CADASTRO</h4>
    </div>

    @if(Auth::user()->level >= 7)
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('usersDataFlex_edit.show', $userDataFlex->id) }}" class="btn btn-warning btn-md fw-bold px-4 me-2">Dados do Histórico</a>
            <a href="{{ route('users_create.show') }}" class="btn btn-success btn-md px-4 me-2">Novo Usuário</a>
            <a href="{{ route('users_list.show') }}" class="btn btn-info btn-md px-4 me-2">Voltar para a Lista</a>
        </div>
    @endif

    <form method="POST" action="{{ route('users_update_neejacpdv.show', [$user->id, $nicheId]) }}"  enctype="multipart/form-data" class="m-4">
        @csrf
        @method('PUT')
        <div class="row mb-2">
            <label for="name" class="col-sm-2 col-form-label"><strong>Nome do Aluno:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly required>
            </div>
        </div>

        {{-- Se o nível do usuário for maior ou igual a 7, permitir edição --}}
        @if(Auth::user()->level >= 7)
            <div class="row mb-2">
                <label for="email" class="col-sm-2 col-form-label"><strong>Email/Usuário:</strong></label>
                <div class="col">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>  
            </div>
        @else
            <div class="row mb-2">
                <label for="email" class="col-sm-2 col-form-label"><strong>Email/Usuário:</strong></label>
                <div class="col">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                </div>
            </div>
        @endif
        {{-- Se o nível do usuário for menor que 9, permitir edição --}}        
        @if($user->level < 9)
            <div class="row mb-2">
                <label for="level" class="col-sm-2 col-form-label"><strong>*Nível de Acesso:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="level" name="level" value="{{ $user->level }}" readonly>
                </div>
                <label for="iseNumber" class="col-sm-2 col-form-label"><strong>*Número do ISE:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="iseNumber" name="iseNumber" value="{{ $iseNumber }}" readonly>
                </div>
            </div>
        @else
            <div class="row mb-2">
                <label for="level" class="col-sm-2 col-form-label"><strong>*Nível de Acesso:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="level" name="level" value="{{ $user->level }}" required>
                </div>
                <label for="iseNumber" class="col-sm-2 col-form-label"><strong>*Número do ISE:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="iseNumber" name="iseNumber" value="{{ $iseNumber }}" required>
                </div>  
            </div>
        @endif

        <div class="py-2 mb-4 rounded">
            <h6 class="text-center">Documentos</h6>
            <hr style="margin:8px 0; opacity:.3;">
        </div>
 
        <div class="row mb-2">
            <label for="type" class="col-sm-2 col-form-label"><strong>*Tipo de Documento:</strong></label>
            <div class="col">
                <select class="form-select" id="type" name="type" required>
                    <option value="Indefinido" {{ $type === 'Indefinido' ? 'selected' : '' }}>Indefinido</option>
                    <option value="Registro Geral - CPF" {{ $type === 'Registro Geral - CPF' ? 'selected' : '' }}>Carteira de Identidade Nacional - CIN - Usa CPF</option>
                    <option value="Registro Geral" {{ $type === 'Registro Geral' ? 'selected' : '' }}>Registro Geral - RG</option>
                    <option value="Passaporte" {{ $type === 'Passaporte' ? 'selected' : '' }}>Passaporte</option>
                    <option value="Carteira de Motorista" {{ $type === 'Carteira de Motorista' ? 'selected' : '' }}>Carteira Nacional de Habilitação - CNH</option>
                    <option value="Carteira de Trabalho" {{ $type === 'Carteira de Trabalho' ? 'selected' : '' }}>Carteira de Trabalho - CTPS</option>
                    <option value="Registro Migratório" {{ $type === 'Registro Migratório' ? 'selected' : '' }}>Carteira de Registro Nacional Migratório - CRNM</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label for="doc_number" class="col-sm-2 col-form-label"><strong>*Núm. Documento:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="doc_number" name="doc_number" value="{{ $doc_number }}" required>
            </div>
            <label for="issuer" class="col-sm-2 col-form-label"><strong>*Órgão Emissor:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="issuer" name="issuer" value="{{ $issuer }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="name" class="col-sm-2 col-form-label"><strong>*Nome:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="social_name" class="col-sm-2 col-form-label"><strong>Nome Social:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="social_name" name="social_name" value="{{ $social_name }}">
            </div>
        </div>

        <div class="row mb-2">
            <label for="birth" class="col-sm-2 col-form-label"><strong>*Data Nascimento:</strong></label>
            <div class="col">
                <input type="date" class="form-control" id="birth" name="birth" value="{{ $birth }}" required>
            </div>
            <label for="birthplace" class="col-sm-2 col-form-label"><strong>*Local Nascimento:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="birthplace" name="birthplace" value="{{ $birthplace }}" required>
            </div>
            <label for="nationality" class="col-sm-2 col-form-label"><strong>*Nacionalidade:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $nationality }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="issue_date" class="col-sm-2 col-form-label"><strong>*Data de Emissão:</strong></label>
            <div class="col">
                <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ $issue_date }}" required>
            </div>
            <label for="valid_to" class="col-sm-2 col-form-label"><strong>Validade:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="valid_to" name="valid_to" value="{{ $valid_to }}" required>
            </div>
       </div>
        <div class="row mb-2">
            <label for="mother" class="col-sm-2 col-form-label"><strong>*Nome da Mãe:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="mother" name="mother" value="{{ $mother }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="father" class="col-sm-2 col-form-label"><strong>Nome do Pai:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="father" name="father" value="{{ $father }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="cpf" class="col-sm-2 col-form-label"><strong>*CPF:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $cpf }}" maxlength="14" inputmode="numeric" required>
            </div>
            <label for="race" class="col-sm-2 col-form-label"><strong>*Raça:</strong></label>
            <div class="col">
                <select class="form-select" id="race" name="race" required>
                    <option value="Indefinida" {{ $race === 'Indefinida' ? 'selected' : '' }}>Indefinida</option>
                    <option value="Branca" {{ $race === 'Branca' ? 'selected' : '' }}>Branca</option>
                    <option value="Preta" {{ $race === 'Preta' ? 'selected' : '' }}>Preta</option>
                    <option value="Amarela" {{ $race === 'Amarela' ? 'selected' : '' }}>Amarela</option>
                    <option value="Parda" {{ $race === 'Parda' ? 'selected' : '' }}>Parda</option>
                    <option value="Indígena" {{ $race === 'Indígena' ? 'selected' : '' }}>Indígena  </option>
                </select>
            </div>
        </div>
        {{-- <div class="row mb-2">
            <label for="cnh" class="col-sm-2 col-form-label"><strong>CNH:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cnh" name="cnh" value="{{ $cnh }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="rg" class="col-sm-2 col-form-label"><strong>RG:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="rg" name="rg" value="{{ $rg }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="workcard" class="col-sm-2 col-form-label"><strong>Cart. Trabalho:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="workcard" name="workcard" value="{{ $workcard }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="election" class="col-sm-2 col-form-label"><strong>Título de Eleitor:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="election" name="election" value="{{ $election }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="passport" class="col-sm-2 col-form-label"><strong>Passaporte:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="passport" name="passport" value="{{ $passport }}">
            </div>
        </div> --}}
        <div class="row mb-2">
            <label for="marital" class="col-sm-2 col-form-label"><strong>Estado Civil:</strong></label>
            <div class="col">
                <select class="form-select" id="marital" name="marital" required>
                    <option value="Indefinido" {{ $marital === 'Indefinido' ? 'selected' : '' }}>Indefinido</option>
                    <option value="Solteiro" {{ $marital === 'Solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                    <option value="Casado" {{ $marital === 'Casado' ? 'selected' : '' }}>Casado(a)</option>
                    <option value="Divorciado" {{ $marital === 'Divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                    <option value="Viúvo" {{ $marital === 'Viúvo' ? 'selected' : '' }}>Viúvo(a)</option>
                    <option value="Separado" {{ $marital === 'Separado' ? 'selected' : '' }}>Separado(a)</option>
                    <option value="União Estável" {{ $marital === 'União Estável' ? 'selected' : '' }}>União Estável</option>
                </select>
            </div>
            <label for="profession" class="col-sm-2 col-form-label"><strong>Profissão:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="profession" name="profession" value="{{ $profession }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="biological_sex" class="col-sm-2 col-form-label"><strong>*Sexo Biológico:</strong></label>
            <div class="col">
                <select class="form-select" id="biological_sex" name="biological_sex" required>
                    <option value="Masculino" {{ $biological_sex === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ $biological_sex === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>
            <label for="gender_identity" class="col-sm-2 col-form-label"><strong>Identidade de Gênero:</strong></label>
            <div class="col">
                <select class="form-select" id="gender_identity" name="gender_identity" required>
                    <option value="Masculino" {{ $gender_identity === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ $gender_identity === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="Não-binário" {{ $gender_identity === 'Não-binário' ? 'selected' : '' }}>Não-binário</option>
                </select>
            </div>
        </div>

        <div class="py-2 mb-4 rounded">
            <h6 class="text-center">Endereço e Contatos</h6>
            <hr style="margin:8px 0; opacity:.3;">
        </div>        

        <div class="row mb-2">
            <label for="street" class="col-sm-1 col-form-label"><strong>*Rua:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="street" name="street" value="{{ $street }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="number" class="col-sm-1 col-form-label"><strong>*Número:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="number" name="number" value="{{ $number }}" required>
            </div>
             <label for="neighborhood_user" class="col-sm-1 col-form-label"><strong>*Bairro:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="neighborhood_user" name="neighborhood_user" value="{{ $neighborhood_user }}" required>
            </div>
             <label for="zip" class="col-sm-1 col-form-label"><strong>*CEP:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="zip" name="zip" value="{{ $zip }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="city" class="col-sm-1 col-form-label"><strong>*Cidade:</strong>  </label>
            <div class="col">
                <input type="text" class="form-control" id="city" name="city" value="{{ $city }}" required  >
            </div>
            <label for="state" class="col-sm-1 col-form-label"><strong>*Estado:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="state" name="state" value="{{ $state }}" required>
            </div>
            <label for="country" class="col-sm-1 col-form-label"><strong>*País:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="country" name="country" value="{{ $country }}" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="cellphone" class="col-sm-1 col-form-label"><strong>*Celular:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ $cellphone }}" required>
            </div>
            <label for="phone" class="col-sm-1 col-form-label"><strong>Telefone:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $phone }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="whatsapp" class="col-sm-1 col-form-label"><strong>WhatsApp:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $whatsapp }}">
            </div>
            <label for="telegram" class="col-sm-1 col-form-label"><strong>Telegram:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="telegram" name="telegram" value="{{ $telegram }}">
            </div>
        </div>
        <div class="row mb-2">
            <label for="facebook" class="col-sm-1 col-form-label"><strong>Facebook:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $facebook }}">
            </div>
            <label for="instagram" class="col-sm-1 col-form-label"><strong>Instagram:</strong></label>
            <div class="col">
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $instagram }}">
            </div>
        </div>
        {{-- -------------------------------------------------------------------------------------------------------------------------------------- --}}
        <div class="row mb-2">
            <label for="profile_image" class="col-sm-2 col-form-label"><strong>*Foto de Perfil:</strong></label>
            @if($profile_image && $profile_image !== 'Fazer upload')
                <div class="col">
                    <img src="{{ asset('storage/' . $profile_image) }}" alt="Imagem de Perfil" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
        </div>
        <div class="row mb-2">
            <div class="col">
                Já possui foto? Faça o upload ou capture uma nova
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <div class="col">
                <label><strong>Foto</strong> (upload) </label><br>
                @if($profile_image && $profile_image !== 'Fazer upload')
                    <p><button class="btn btn-info btn-sm"><a href="{{ asset('storage/' . $profile_image) }}" target="_blank">{{ $profile_image }}</a></button></p>
                    {{-- <p>{{ $profile_image ?? '----------------' }}</p> --}}
                @endif
                <input type="file" name="profile_image" accept="image/*">
            </div>
        </div>
        <hr>
        <div class="row align-items-start">
            <div class="col">
                <label><strong>Foto</strong> (câmera)</label><br>
                <div style="position:relative; width:320px; max-width:100%;">
                    <video id="cam" autoplay playsinline style="width:320px; height:auto; background:#000; display:block;"></video>
                    <div style="position:absolute; inset:7% 14%; border:2px solid rgba(255,255,255,.72); border-radius:50% / 42%; pointer-events:none; box-shadow:0 0 0 9999px rgba(0,0,0,.12) inset;"></div>
                </div>
                <div style="margin-top:8px; color:#555; font-size:13px; max-width:320px;">
                    Para o snapshot, mantenha o rosto bem visível e enquadrado no centro da câmera.
                </div>
                <canvas id="snapshot" style="display:none;"></canvas>
                <input type="hidden" name="photo_capture" id="photo_capture">
            </div>
            <div class="col">
                <label>Prévia da captura</label><br>
                <div style="position:relative; width:320px; max-width:100%;">
                    <img id="camPreview" alt="Prévia do snapshot" style="width:240px; height:320px; border:1px solid #ccc; background:#f8f8f8; object-fit:cover; display:block;" />
                </div>        
            </div>
            <div style="margin-top:8px; display:flex; gap:8px; flex-wrap:wrap;">
                <button type="button" id="btnStart">Abrir câmera</button>
                <button type="button" id="btnShot">Capturar</button>
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <div class="col">
                <label><strong>Documento</strong> (upload imagem/pdf)</label><br>
                <small>Ex.: Carteira de Identidade, Carteira de Trabalho, CNH (que possua naturalidade)</small><br>
                @if($profile_document && $profile_document !== 'Fazer upload')
                    <p><button class="btn btn-info btn-sm"><a href="{{ asset('storage/' . $profile_document) }}" target="_blank">{{ $profile_document }}</a></button></p>
                @endif
                <input type="file" name="profile_document" accept="image/*,.pdf">
           </div>
        </div>
        <hr>
        <div class="row mb-2">
            <div class="col">
                <label><strong>Comprovante de Escolaridade</strong> (upload imagem/pdf)</label><br>
                <small>Ex.: Histórico Escolar (Aluno Ensino Médio), Certificado Parcial (ENEM ou ENCCEJA)</small><br>
                @if($proof_of_schooling && $proof_of_schooling !== 'Fazer upload')
                    <p><button class="btn btn-info btn-sm"><a href="{{ asset('storage/' . $proof_of_schooling) }}" target="_blank">{{ $proof_of_schooling }}</a></button></p>
                @endif
                <input type="file" name="proof_of_schooling" accept="image/*,.pdf">
           </div>
        </div>
        <hr>
        <div class="row mb-2">
            <div class="col">
                <label><strong>Comprovante de Residência</strong> (upload imagem/pdf)</label><br>
                <small>Ex.: Conta de Luz, Conta de Água, Contrato de Aluguel.</small><br>
                @if($proof_of_residence && $proof_of_residence !== 'Fazer upload')
                    <p><button class="btn btn-info btn-sm"><a href="{{ asset('storage/' . $proof_of_residence) }}" target="_blank">{{ $proof_of_residence }}</a></button></p>
                @endif
                <input type="file" name="proof_of_residence" accept="image/*,.pdf">
           </div>
        </div>

        <div class="row mb-3 py-3">
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>



<script>
let stream = null;
const video = document.getElementById('cam');
const canvas = document.getElementById('snapshot');
const photoCapture = document.getElementById('photo_capture');
const camPreview = document.getElementById('camPreview');

document.getElementById('btnStart').onclick = async () => {
  stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false });
  video.srcObject = stream;
};

document.getElementById('btnShot').onclick = () => {
  const w = video.videoWidth || 640;
  const h = video.videoHeight || 480;

    const targetRatio = 3 / 4;
    let cropW = w;
    let cropH = Math.round(cropW / targetRatio);

    if (cropH > h) {
        cropH = h;
        cropW = Math.round(cropH * targetRatio);
    }

    const cropX = Math.round((w - cropW) / 2);
    const cropY = Math.round((h - cropH) / 2);

    canvas.width = 240;
    canvas.height = 320;
  const ctx = canvas.getContext('2d');
    ctx.drawImage(video, cropX, cropY, cropW, cropH, 0, 0, 240, 320);

    const snapshotDataUrl = canvas.toDataURL('image/jpeg', 0.85);
    photoCapture.value = snapshotDataUrl; // base64
    camPreview.src = snapshotDataUrl;
};

function onlyDigits(value) {
    return (value || '').replace(/\D/g, '');
}

function maskCpf(value) {
    const digits = onlyDigits(value).slice(0, 11);
    return digits
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
}

function isValidCpf(cpfValue) {
    const cpf = onlyDigits(cpfValue);
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false;

    let sum = 0;
    for (let i = 0; i < 9; i++) sum += parseInt(cpf.charAt(i), 10) * (10 - i);
    let check = (sum * 10) % 11;
    if (check === 10) check = 0;
    if (check !== parseInt(cpf.charAt(9), 10)) return false;

    sum = 0;
    for (let i = 0; i < 10; i++) sum += parseInt(cpf.charAt(i), 10) * (11 - i);
    check = (sum * 10) % 11;
    if (check === 10) check = 0;
    return check === parseInt(cpf.charAt(10), 10);
}

function validateCpfField(input) {
    const value = input.value.trim();
    if (value === '') {
        input.setCustomValidity('');
        return;
    }
    if (!isValidCpf(value)) {
        input.setCustomValidity('CPF inválido. Informe um CPF válido.');
    } else {
        input.setCustomValidity('');
    }
}

const cpfInput = document.getElementById('cpf');
if (cpfInput) {
    cpfInput.value = maskCpf(cpfInput.value);

    cpfInput.addEventListener('input', (e) => {
        e.target.value = maskCpf(e.target.value);
        e.target.setCustomValidity('');
    });

    cpfInput.addEventListener('blur', (e) => {
        validateCpfField(e.target);
    });

    const form = cpfInput.closest('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            validateCpfField(cpfInput);
            if (!form.checkValidity()) {
                e.preventDefault();
                form.reportValidity();
            }
        });
    }
}
</script>


</div>
@endsection




