@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Visualizar Nicho </h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('niches_create.show') }}" class="btn btn-success">Novo Nicho</a>
            <a href="{{ route('niches_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
        </div>
        @php
            $nicheName = isset($niche->niche) ? $niche->niche : 'Nicho não cadastrado';
            $data = $niche->niche_data;
            if (is_string($data)) {
                try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
            }
            $description = isset($data['description']) ? $data['description'] : 'Descrição não cadastrada';
            $company_name = isset($data['company_name']) ? $data['company_name'] : 'Nome da empresa não cadastrada';
            $trade_name = isset($data['trade_name']) ? $data['trade_name'] : 'Nome fantasia não cadastrado';
            $foundation = isset($data['foundation']) ? $data['foundation'] : 'Fundação não cadastrada';
            $authorization1 = isset($data['authorization1']) ? $data['authorization1'] : 'Autorização 1 não cadastrada';
            $authorization2 = isset($data['authorization2']) ? $data['authorization2'] : 'Autorização 2 não cadastrada';
            $cnpj = isset($data['cnpj']) ? $data['cnpj'] : 'CNPJ não cadastrado';
            $address = isset($data['address']) ? $data['address'] : [
                'street' => 'Rua não cadastrada',
                'number' => 'Número não cadastrado',
                'zip' => 'CEP não cadastrado',
                'neighborhood' => 'Bairro não cadastrado',
                'locality' => 'Localidade não cadastrada',
                'city' => 'Cidade não cadastrada',
                'state' => 'Estado não cadastrado',
                'country' => 'Brasil',
                'cellphone' => 'Celular não cadastrado',
                'phone' => 'Telefone não cadastrado',
                'site' => 'Site não cadastrado',
                'email' => 'Email não cadastrado',
                'whatsapp' => 'WhatsApp não cadastrado',
                'telegram' => 'Telegram não cadastrado',
                'facebook' => 'Facebook não cadastrado',
                'instagram' => 'Instagram não cadastrado',
            ];
            $street = $address['street'] ?? '';
            $number = $address['number'] ?? '';
            $zip = $address['zip'] ?? '';
            $neighborhood = $address['neighborhood'] ?? '';
            $locality = $address['locality'] ?? '';
            $city = $address['city'] ?? '';
            $state = $address['state'] ?? '';
            $country = $address['country'] ?? '';
            $cellphone = $address['cellphone'] ?? '';
            $phone = $address['phone'] ?? '';
            $site = $address['site'] ?? '';
            $email = $address['email'] ?? '';
            $whatsapp = $address['whatsapp'] ?? '';
            $telegram = $address['telegram'] ?? '';
            $facebook = $address['facebook'] ?? '';
            $instagram = $address['instagram'] ?? '';
            if (is_string($address)) {
                try { $address = json_decode($address, true); } catch (\Throwable $e) { $address = []; }
            }   
            $street = old('address.street', $street);
            $number = old('address.number', $number);
            $zip = old('address.zip', $zip);
            $neighborhood = old('address.neighborhood', $neighborhood);
            $locality = old('address.locality', $locality);
            $city = old('address.city', $city);
            $state = old('address.state', $state);
            $country = old('address.country', $country);
            $cellphone = old('address.cellphone', $cellphone);
            $phone = old('address.phone', $phone);
            $site = old('address.site', $site);
            $email = old('address.email', $email);
            $whatsapp = old('address.whatsapp', $whatsapp);
            $telegram = old('address.telegram', $telegram);
            $facebook = old('address.facebook', $facebook);
            $instagram = old('address.instagram', $instagram);
            $rules = isset($data['rules']) ? $data['rules'] : [
                'rule0' => 'Regra 1 não cadastrada',
                'rule1' => 'Regra 2 não cadastrada',
                'rule2' => 'Regra 3 não cadastrada',
                'rule3' => 'Regra 4 não cadastrada',
                'rule4' => 'Regra 5 não cadastrada',
                'rule5' => 'Regra 6 não cadastrada',
                'rule6' => 'Regra 7 não cadastrada',
                'rule7' => 'Regra 8 não cadastrada',
                'rule8' => 'Regra 9 não cadastrada',
                'rule9' => 'Regra 10 não cadastrada'
            ];
            $rule0 = $rules['rule0'] ?? '';
            $rule1 = $rules['rule1'] ?? '';
            $rule2 = $rules['rule2'] ?? '';
            $rule3 = $rules['rule3'] ?? '';
            $rule4 = $rules['rule4'] ?? '';
            $rule5 = $rules['rule5'] ?? '';
            $rule6 = $rules['rule6'] ?? '';
            $rule7 = $rules['rule7'] ?? '';
            $rule8 = $rules['rule8'] ?? '';
            $rule9 = $rules['rule9'] ?? '';
            if (is_string($rules)) {
                try { $rules = json_decode($rules, true); } catch (\Throwable $e) { $rules = []; }
            }   
            $rule0 = old('rules.rule0', $rule0);
            $rule1 = old('rules.rule1', $rule1);
            $rule2 = old('rules.rule2', $rule2);
            $rule3 = old('rules.rule3', $rule3);
            $rule4 = old('rules.rule4', $rule4);
            $rule5 = old('rules.rule5', $rule5);
            $rule6 = old('rules.rule6', $rule6);
            $rule7 = old('rules.rule7', $rule7);
            $rule8 = old('rules.rule8', $rule8);
            $rule9 = old('rules.rule9', $rule9);
            $quantidadeRules = count($rules);
            $quantidadeAddress = count($address);
        @endphp
        <div class="row mb-2">
            <strong>Nome:</strong>
            <div>
                {{ $nicheName }}
            </div>
            <div class="py-2 mb-4 rounded">
                <h6 class="text-center">Dados do Nicho</h6>
                <hr style="margin:4px 0; opacity:.3;">
            </div>
            <strong>Descrição:</strong>
            <div>
                {{ $description }}
            </div>
            <strong>Nome Comercial:</strong>
            <div>
                {{ $company_name }}
            </div>
            <strong>Nome Fantasia:</strong>
            <div>
                {{ $trade_name }}
            </div>
            <strong>Fundação:</strong>
            <div>
                {{ $foundation }}
            </div>
            <strong>Autorização 1:</strong>
            <div>
                {{ $authorization1 }}
            </div>
            <strong>Autorização 2:</strong>
            <div>
                {{ $authorization2 }}
            </div>
            <strong>CNPJ:</strong>
            <div>
                {{ $cnpj }}
            </div>
            <div class="py-2 mb-4 rounded">
                <h6 class="text-center">Endereço e Contatos do Nicho</h6>
                <hr style="margin:4px 0; opacity:.3;">
            </div>
           <strong>Rua:</strong>
            <div>
                {{ $street }}
            </div>
            <strong>Número:</strong>
            <div>
                {{ $number }}
            </div>
                 <strong>CEP:</strong>
            <div>
                {{ $zip }}
            </div>
            <strong>Bairro:</strong>
            <div>
                {{ $neighborhood }}
            </div>
            <strong>Localidade:</strong>
            <div>
                {{ $locality }}
            </div>
            <strong>Cidade:</strong>
            <div>
                {{ $city }}
            </div>
            <strong>Estado:</strong>
            <div>
                {{ $state }}
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
            <strong>Site:</strong>
            <div>
                {{ $site }}
            </div>
            <strong>E-mail:</strong>
            <div>
                {{ $email }}
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
            <div class="py-2 mb-4 rounded">
                <h6 class="text-center">Regras do Nicho</h6>
                <hr style="margin:4px 0; opacity:.3;"> 
           </div>
            <strong>Regra 1:</strong>
            <div>
                {!! nl2br(e($rule0)) !!}
            </div>
            <strong>Regra 2:</strong>
            <div>
                {!! nl2br(e($rule1)) !!}
            </div>
            <strong>Regra 3:</strong>
            <div>
                {!! nl2br(e($rule2)) !!}
            </div>
            <strong>Regra 4:</strong>
            <div>
                {!! nl2br(e($rule3)) !!}
            </div>
            <strong>Regra 5:</strong>
            <div>
                {!! nl2br(e($rule4)) !!}
            </div>
            <strong>Regra 6:</strong>
            <div>
                {!! nl2br(e($rule5)) !!}
            </div>
            <strong>Regra 7:</strong>
            <div>
                {!! nl2br(e($rule6)) !!}
            </div>
            <strong>Regra 8:</strong>
            <div>
                {!! nl2br(e($rule7)) !!}
            </div>
            <strong>Regra 9:</strong>
            <div>
                {!! nl2br(e($rule8)) !!}
            </div>
            <strong>Regra 10:</strong>
            <div>
                {!! nl2br(e($rule9)) !!}
            </div>
        </div>
    </div>
@endsection
