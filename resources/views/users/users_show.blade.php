@extends("layouts.app")
@section('title', 'Usuário - Idoa')
@section("content")
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Visualizar Usuário </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('users_create.show') }}" class="btn btn-success">Novo Usuário</a>
        <a href="{{ route('users_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
    </div>
    <div class="row mb-2">
        <strong>Nome:</strong>
        <div>
             {{ $user->name }}
        </div>
        <strong>Email:</strong>
        <div>
             {{ $user->email }}
        </div>
        <strong>Nível de Acesso:</strong>
        <div>
             {{ $user->level }}
        </div>
        <strong>Data de Cadastro:</strong>
        <div>
            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}
             {{-- {{ $user->created_at }} --}}
        </div>
        <strong>Atualizado em:</strong>
        <div>
            {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}
        </div>
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


     //    $data = $user->address_data;
     //    if (is_string($data)) {
     //        try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
     //    }

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
    @endphp
    <div class="py-2 mb-4 rounded">
        <h6 class="text-center">Endereço e Contatos do Usuário</h6>
        <hr style="margin:8px 0; opacity:.3;">
    </div>        
    <div class="row mb-2">
        <strong>Rua:</strong>
        <div>
             {{ $street }}
        </div>
        <strong>Número:</strong>
        <div>
             {{ $number }}
        </div>
        <strong>Cidade:</strong>
        <div>
             {{ $city }}
        </div>
        <strong>Estado:</strong>
        <div>
             {{ $state }}
        </div>
        <strong>CEP:</strong>
        <div>
             {{ $zip }}
        </div>
        <strong>País:</strong>
        <div>
             {{ $country }}
        </div>
        <strong>Celular:</strong>
        <div>
             {{ $cellphone }}
        </div>
        <strong>Telefone:</strong>
        <div>
             {{ $phone }}
        </div>
        <strong>WhatsApp:</strong>
        <div>
             {{ $whatsapp }}
        </div>
        <strong>Telegram:</strong>
        <div>
             {{ $telegram }}    
        </div>
        <strong>Facebook:</strong>
        <div>
             {{ $facebook }}
        </div>  
        <strong>Instagram:</strong>
        <div>
             {{ $instagram }}
        </div>  
    </div>
        <div class="py-2 mb-4 rounded">
            <h6 class="text-center">Documentos do Usuário</h6>
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

          //   $dataDoc = $user->document_data;
          //   if (is_string($dataDoc)) {
          //       try { $dataDoc = json_decode($dataDoc, true); } catch (\Throwable $e) { $dataDoc = []; }
          //   }

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
        @endphp
    <div class="row mb-2">
        <strong>Tipo de Documento:</strong>
        <div>
             {{ $type }}
        </div>
        <strong>Número do Documento:</strong>
        <div>
             {{ $doc_number }}
        </div>
        <strong>Órgão Emissor:</strong>
        <div>
             {{ $issuer }}
        </div>
        <strong>Data de Nascimento:</strong>
        <div>
             {{ \Carbon\Carbon::parse($user->birth)->format('d/m/Y') }}
        </div>
        <strong>Local de Nascimento:</strong>
        <div>
             {{ $birthplace }}
        </div>
        <strong>Nacionalidade:</strong>
        <div>
             {{ $nationality }}
        </div>
        <strong>Data de Emissão:</strong>
        <div>
             {{ \Carbon\Carbon::parse($issue_date)->format('d/m/Y') }}
        </div>
        <strong>Data de Validade:</strong>
        <div>
             {{ \Carbon\Carbon::parse($valid_to)->format('d/m/Y') }}
        </div>
        <strong>CNH:</strong>
        <div>
             {{ $cnh }}
        </div>
        <strong>RG:</strong>
        <div>
             {{ $rg }}
        </div>
        <strong>CPF:</strong>
        <div>
             {{ $cpf }}
        </div>
        <strong>Carteira de Trabalho:</strong>
        <div>
             {{ $workcard }}
        </div>
        <strong>Título de Eleitor:</strong>
        <div>
             {{ $election }}
        </div>
        <strong>Passaporte:</strong>
        <div>
             {{ $passport }}
        </div>
        <strong>Nome da Mãe:</strong>
        <div>
             {{ $mother }}
        </div>
        <strong>Nome do Pai:</strong>
        <div>
             {{ $father }}
        </div>
        <strong>Estado Civil:</strong>
        <div>
             {{ $marital }}
        </div>
        <strong>Profissão:</strong>
        <div>
             {{ $profession }}
        </div>
        <strong>Sexo:</strong>
        <div>
             {{ $gender }}
        </div>
    </div>
</div>
@endsection