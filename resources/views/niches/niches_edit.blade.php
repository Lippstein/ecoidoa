@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Editar Nicho </h4>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('niches_create.show') }}" class="btn btn-success">Novo Nicho</a>
            <a href="{{ route('niches_list.show') }}" class="btn btn-info">Voltar para a Lista</a>
        </div>
        <form method="POST" action="{{ route('niches_update.show', $niche->id) }}"  class="m-4">
            @csrf
            @method('PUT')
            <div class="row mb-2">
                    <label for="niche" class="col-sm-2 col-form-label"><strong>Nome do Nicho:</strong></label>
                    <div class="col">
                        <input type="text" class="form-control" id="niche" name="niche" value="{{ $niche->niche }}" required autofocus>
                    </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <h6 class="text-center">Editar Dados do Nicho</h6>
                <hr style="margin:8px 0; opacity:.3;">
            </div>
        
            @php
                $data = $niche->niche_data;
                if (is_string($data)) {
                    try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
                }
                $description = isset($data['description']) ? $data['description'] : 'Descrição não cadastrada';
                $company_name = isset($data['company_name']) ? $data['company_name'] : 'Nome da empresa não cadastrada';
                $trade_name = isset($data['trade_name']) ? $data['trade_name'] : 'Nome fantasia não cadastrado';
                $foundation = isset($data['foundation']) ? $data['foundation'] : 'Fundação não cadastrada';
                $authorization = isset($data['authorization']) ? $data['authorization'] : 'Autorização ou CNPJ não cadastrada';
                $address = isset($data['address']) ? $data['address'] : [
                    'street' => 'Rua não cadastrada',
                    'number' => 'Número não cadastrado',
                    'city' => 'Cidade não cadastrada',
                    'state' => 'Estado não cadastrado',
                    'zip' => 'CEP não cadastrado',
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
                $city = $address['city'] ?? '';
                $state = $address['state'] ?? '';
                $zip = $address['zip'] ?? '';
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
                $city = old('address.city', $city);
                $state = old('address.state', $state);
                $zip = old('address.zip', $zip);
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

            <div class="row col mb-2">
                <label for="description" class="col-sm-2 col-form-label"><strong>Descrição:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $description) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="company_name" class="col-sm-2 col-form-label"><strong>Nome Comercial:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company_name) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="trade_name" class="col-sm-2 col-form-label"><strong>Nome Fantasia:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="trade_name" name="trade_name" value="{{ old('trade_name', $trade_name) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="foundation" class="col-sm-2 col-form-label"><strong>Fundação:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="foundation" name="foundation" value="{{ old('foundation', $foundation) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="authorization" class="col-sm-2 col-form-label"><strong>Autorização:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" id="authorization" name="authorization" value="{{ old('authorization', $authorization) }}" required autofocus>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <h6 class="text-center">Editar Endereço e Contatos do Nicho</h6>
                <hr style="margin:8px 0; opacity:.3;">
            </div>        
            <div class="row col mb-2">
                <label for="street" class="col-sm-2 col-form-label"><strong>Rua:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[street]" value="{{ old('address.street', $street) }}" required autofocus>
           </div>
            </div>
            <div class="row col mb-2">
                <label for="number" class="col-sm-2 col-form-label"><strong>Número:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[number]" value="{{ old('address.number', $number) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="city" class="col-sm-2 col-form-label"><strong>Cidade:</strong>  </label>
                <div class="col">
                    <input type="text" class="form-control" name="address[city]" value="{{ old('address.city', $city) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="state" class="col-sm-2 col-form-label"><strong>Estado:</strong> </label>
                <div class="col">
                    <input type="text" class="form-control" name="address[state]" value="{{ old('address.state', $state) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="zip" class="col-sm-2 col-form-label"><strong>CEP:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[zip]" value="{{ old('address.zip', $zip) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="country" class="col-sm-2 col-form-label"><strong>País:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[country]" value="{{ old('address.country', $country) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="cellphone" class="col-sm-2 col-form-label"><strong>Celular:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[cellphone]" value="{{ old('address.cellphone', $cellphone) }}" required autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="phone" class="col-sm-2 col-form-label"><strong>Telefone:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[phone]" value="{{ old('address.phone', $phone) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="site" class="col-sm-2 col-form-label"><strong>Site:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[site]" value="{{ old('address.site', $site) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="email" class="col-sm-2 col-form-label"><strong>Email:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[email]" value="{{ old('address.email', $email) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="whatsapp" class="col-sm-2 col-form-label"><strong>WhatsApp:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[whatsapp]" value="{{ old('address.whatsapp', $whatsapp) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="telegram" class="col-sm-2 col-form-label"><strong>Telegram:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[telegram]" value="{{ old('address.telegram', $telegram) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="facebook" class="col-sm-2 col-form-label"><strong>Facebook:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[facebook]" value="{{ old('address.facebook', $facebook) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="instagram" class="col-sm-2 col-form-label"><strong>Instagram:</strong></label>
                <div class="col">
                    <input type="text" class="form-control" name="address[instagram]" value="{{ old('address.instagram', $instagram) }}" autofocus>
                </div>
            </div>
            <div class="row col mb-2">
                <h6 class="text-center">Editar Regras do Nicho</h6>
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 1:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule0]" rows="3" autofocus>{{ old('rules.rule0', $rule0) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 2:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule1]" rows="3" autofocus>{{ old('rules.rule1', $rule1) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 3:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule2]" rows="3" autofocus>{{ old('rules.rule2', $rule2) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 4:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule3]" rows="3" autofocus>{{ old('rules.rule3', $rule3) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 5:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule4]" rows="3" autofocus>{{ old('rules.rule4', $rule4) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 6:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule5]" rows="3" autofocus>{{ old('rules.rule5', $rule5) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 7:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule6]" rows="3" autofocus>{{ old('rules.rule6', $rule6) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 8:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule7]" rows="3" autofocus>{{ old('rules.rule7', $rule7) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 9:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule8]" rows="3" autofocus>{{ old('rules.rule8', $rule8) }}</textarea>
                </div>
            </div>
            <div class="row col mb-2">
                <label for="rules" class="col-sm-2 col-form-label"><strong>Regra 10:</strong></label>
                <div class="col">
                    <textarea class="form-control" name="rules[rule9]" rows="3" autofocus>{{ old('rules.rule9', $rule9) }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
@endsection
