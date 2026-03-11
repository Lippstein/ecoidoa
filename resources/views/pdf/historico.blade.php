@php
    $data = $userDataFlex->user_profile;
    if (is_string($data)) {
        try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
    }
    $certificationEFSI = isset($data['certificationEFSI']) ? $data['certificationEFSI'] : ''; 
    $conclusionCertificationEFSI = isset($data['conclusionCertificationEFSI']) ? $data['conclusionCertificationEFSI'] : ''; 
    $ak1EFSIName = isset($data['ak1EFSIName']) ? $data['ak1EFSIName'] : '';
    $ak1EFSIDescription = isset($data['ak1EFSIDescription']) ? $data['ak1EFSIDescription'] : '';
    $ak1EFSIResult = isset($data['ak1EFSIResult']) ? $data['ak1EFSIResult'] : '';
    $ak1EFSIConclusion = isset($data['ak1EFSIConclusion']) ? $data['ak1EFSIConclusion'] : '';
    $ak1EFSIObs = isset($data['ak1EFSIObs']) ? $data['ak1EFSIObs'] : '';

    $certificationEFSF = isset($data['certificationEFSF']) ? $data['certificationEFSF'] : '';
    $conclusionCertificationEFSF = isset($data['conclusionCertificationEFSF']) ? $data['conclusionCertificationEFSF'] : '';
    $ak1EFSFName = isset($data['ak1EFSFName']) ? $data['ak1EFSFName'] : '';
    $ak1EFSFDescription = isset($data['ak1EFSFDescription']) ? $data['ak1EFSFDescription'] : '';
    $ak1EFSFResult = isset($data['ak1EFSFResult']) ? $data['ak1EFSFResult'] : '';
    $ak1EFSFConclusion = isset($data['ak1EFSFConclusion']) ? $data['ak1EFSFConclusion'] : '';
    $ak1EFSFObs = isset($data['ak1EFSFObs']) ? $data['ak1EFSFObs'] : '';
    $ak2EFSFName = isset($data['ak2EFSFName']) ? $data['ak2EFSFName'] : '';
    $ak2EFSFDescription = isset($data['ak2EFSFDescription']) ? $data['ak2EFSFDescription'] : '';
    $ak2EFSFResult = isset($data['ak2EFSFResult']) ? $data['ak2EFSFResult'] : '';
    $ak2EFSFConclusion = isset($data['ak2EFSFConclusion']) ? $data['ak2EFSFConclusion'] : '';
    $ak2EFSFObs = isset($data['ak2EFSFObs']) ? $data['ak2EFSFObs'] : '';
    $ak3EFSFName = isset($data['ak3EFSFName']) ? $data['ak3EFSFName'] : '';
    $ak3EFSFDescription = isset($data['ak3EFSFDescription']) ? $data['ak3EFSFDescription'] : '';
    $ak3EFSFResult = isset($data['ak3EFSFResult']) ? $data['ak3EFSFResult'] : '';        
    $ak3EFSFConclusion = isset($data['ak3EFSFConclusion']) ? $data['ak3EFSFConclusion'] : '';
    $ak3EFSFObs = isset($data['ak3EFSFObs']) ? $data['ak3EFSFObs'] : '';
    $ak4EFSFName = isset($data['ak4EFSFName']) ? $data['ak4EFSFName'] : '';
    $ak4EFSFDescription = isset($data['ak4EFSFDescription']) ? $data['ak4EFSFDescription'] : '';
    $ak4EFSFResult = isset($data['ak4EFSFResult']) ? $data['ak4EFSFResult'] : '';
    $ak4EFSFConclusion = isset($data['ak4EFSFConclusion']) ? $data['ak4EFSFConclusion'] : '';
    $ak4EFSFObs = isset($data['ak4EFSFObs']) ? $data['ak4EFSFObs'] : '';

    $certificationEMAF = isset($data['certificationEMAF']) ? $data['certificationEMAF'] : '';
    $conclusionCertificationEMAF = isset($data['conclusionCertificationEMAF']) ? $data['conclusionCertificationEMAF'] : '';
    $ak1EMAFName = isset($data['ak1EMAFName']) ? $data['ak1EMAFName'] : '';
    $ak1EMAFDescription = isset($data['ak1EMAFDescription']) ? $data['ak1EMAFDescription'] : '';
    $ak1EMAFResult = isset($data['ak1EMAFResult']) ? $data['ak1EMAFResult'] : '';
    $ak1EMAFConclusion = isset($data['ak1EMAFConclusion']) ? $data['ak1EMAFConclusion'] : '';
    $ak1EMAFObs = isset($data['ak1EMAFObs']) ? $data['ak1EMAFObs'] : '';
    $ak2EMAFName = isset($data['ak2EMAFName']) ? $data['ak2EMAFName'] : '';
    $ak2EMAFDescription = isset($data['ak2EMAFDescription']) ? $data['ak2EMAFDescription'] : '';
    $ak2EMAFResult = isset($data['ak2EMAFResult']) ? $data['ak2EMAFResult'] : '';
    $ak2EMAFConclusion = isset($data['ak2EMAFConclusion']) ? $data['ak2EMAFConclusion'] : '';
    $ak2EMAFObs = isset($data['ak2EMAFObs']) ? $data['ak2EMAFObs'] : '';
    $ak3EMAFName = isset($data['ak3EMAFName']) ? $data['ak3EMAFName'] : '';
    $ak3EMAFDescription = isset($data['ak3EMAFDescription']) ? $data['ak3EMAFDescription'] : '';
    $ak3EMAFResult = isset($data['ak3EMAFResult']) ? $data['ak3EMAFResult'] : '';        
    $ak3EMAFConclusion = isset($data['ak3EMAFConclusion']) ? $data['ak3EMAFConclusion'] : '';
    $ak3EMAFObs = isset($data['ak3EMAFObs']) ? $data['ak3EMAFObs'] : '';
    $ak4EMAFName = isset($data['ak4EMAFName']) ? $data['ak4EMAFName'] : '';
    $ak4EMAFDescription = isset($data['ak4EMAFDescription']) ? $data['ak4EMAFDescription'] : '';
    $ak4EMAFResult = isset($data['ak4EMAFResult']) ? $data['ak4EMAFResult'] : '';
    $ak4EMAFConclusion = isset($data['ak4EMAFConclusion']) ? $data['ak4EMAFConclusion'] : '';
    $ak4EMAFObs = isset($data['ak4EMAFObs']) ? $data['ak4EMAFObs'] : '';


    $niche_name = isset($nicheData->niche) ? $nicheData->niche : '';
    $niche_data = $nicheData->niche_data;
    if (is_string($niche_data)) {
        try { $niche_data = json_decode($niche_data, true); } catch (\Throwable $e) { $niche_data = []; }
    }
    $niche_description = isset($niche_data['description']) ? $niche_data['description'] : '';
    $niche_company_name = isset($niche_data['company_name']) ? $niche_data['company_name'] : '';
    $niche_trade_name = isset($niche_data['trade_name']) ? $niche_data['trade_name'] : '';
    $niche_foundation = isset($niche_data['foundation']) ? $niche_data['foundation'] : '';
    $niche_authorization1 = isset($niche_data['authorization1']) ? $niche_data['authorization1'] : '';
    $niche_authorization2 = isset($niche_data['authorization2']) ? $niche_data['authorization2'] : '';
    $niche_cnpj = isset($niche_data['cnpj']) ? $niche_data['cnpj'] : '';

    $niche_address = $niche_data['address'];
    if (is_string($niche_address)) {
        try { $niche_address = json_decode($niche_address, true); } catch (\Throwable $e) { $niche_address = []; }
    }
    $niche_street = $niche_address['street'] ?? '';
    $niche_number = $niche_address['number'] ?? '';
    $niche_zip = $niche_address['zip'] ?? '';
    $niche_neighborhood = $niche_address['neighborhood'] ?? '';
    $niche_locality = $niche_address['locality'] ?? '';
    $niche_city = $niche_address['city'] ?? '';
    $niche_state = $niche_address['state'] ?? '';
    $niche_country = $niche_address['country'] ?? '';
    $niche_cellphone = $niche_address['cellphone'] ?? '';
    $niche_phone = $niche_address['phone'] ?? '';
    $niche_site = $niche_address['site'] ?? '';
    $niche_email = $niche_address['email'] ?? '';
    $niche_whatsapp = $niche_address['whatsapp'] ?? '';
    $niche_telegram = $niche_address['telegram'] ?? '';
    $niche_facebook = $niche_address['facebook'] ?? '';
    $niche_instagram = $niche_address['instagram'] ?? '';

    $user_dataAddress = $userData->address_data;
    if (is_string($user_dataAddress)) {
        try { $user_dataAddress = json_decode($user_dataAddress, true); } catch (\Throwable $e) { $user_dataAddress = []; }
    }

    $user_street = isset($user_dataAddress['street']) ? $user_dataAddress['street'] : '';
    $user_number = isset($user_dataAddress['number']) ? $user_dataAddress['number'] : '';
    $user_city = isset($user_dataAddress['city']) ? $user_dataAddress['city'] : '';
    $user_state = isset($user_dataAddress['state']) ? $user_dataAddress['state'] : '';
    $user_zip = isset($user_dataAddress['zip']) ? $user_dataAddress['zip'] : '';
    $user_country = isset($user_dataAddress['country']) ? $user_dataAddress['country'] : '';
    $user_cellphone = isset($user_dataAddress['cellphone']) ? $user_dataAddress['cellphone'] : '';
    $user_phone = isset($user_dataAddress['phone']) ? $user_dataAddress['phone'] : '';
    $user_whatsapp = isset($user_dataAddress['whatsapp']) ? $user_dataAddress['whatsapp'] : '';
    $user_telegram = isset($user_dataAddress['telegram']) ? $user_dataAddress['telegram'] : '';
    $user_facebook = isset($user_dataAddress['facebook']) ? $user_dataAddress['facebook'] : '';
    $user_instagram = isset($user_dataAddress['instagram']) ? $user_dataAddress['instagram'] : '';

    $user_dataDoc = $userData->document_data;
    if (is_string($user_dataDoc)) {
        try { $user_dataDoc = json_decode($user_dataDoc, true); } catch (\Throwable $e) { $user_dataDoc = []; }
    }

    $user_type = isset($user_dataDoc['type']) ? $user_dataDoc['type'] : '';
    $user_doc_number = isset($user_dataDoc['doc_number']) ? $user_dataDoc['doc_number'] : '';
    $user_issuer = isset($user_dataDoc['issuer']) ? $user_dataDoc['issuer'] : '';
    $user_birth = isset($user_dataDoc['birth']) ? $user_dataDoc['birth'] : '';
    $user_birthplace = isset($user_dataDoc['birthplace']) ? $user_dataDoc['birthplace'] : '';
    $user_nationality = isset($user_dataDoc['nationality']) ? $user_dataDoc['nationality'] : '';
    $user_issue_date = isset($user_dataDoc['issue_date']) ? $user_dataDoc['issue_date'] : '';
    $user_valid_to = isset($user_dataDoc['valid_to']) ? $user_dataDoc['valid_to'] : '';
    $user_cnh = isset($user_dataDoc['cnh']) ? $user_dataDoc['cnh'] : '';
    $user_rg = isset($user_dataDoc['rg']) ? $user_dataDoc['rg'] : '';
    $user_cpf = isset($user_dataDoc['cpf']) ? $user_dataDoc['cpf'] : '';
    $user_workcard = isset($user_dataDoc['workcard']) ? $user_dataDoc['workcard'] : '';
    $user_election = isset($user_dataDoc['election']) ? $user_dataDoc['election'] : '';
    $user_passport = isset($user_dataDoc['passport']) ? $user_dataDoc['passport'] : '';  
    $user_mother = isset($user_dataDoc['mother']) ? $user_dataDoc['mother'] : '';
    $user_father = isset($user_dataDoc['father']) ? $user_dataDoc['father'] : '-';
    $user_marital = isset($user_dataDoc['marital']) ? $user_dataDoc['marital'] : '';
    $user_profession = isset($user_dataDoc['profession']) ? $user_dataDoc['profession'] : '';
    $user_gender = isset($user_dataDoc['gender']) ? $user_dataDoc['gender'] : '';

@endphp

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>{{ $title ?? 'Historico' }}</title>
        <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }    
        </style>
    </head>

    <body>
        <div class="row mb-2">
            <table border="0" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 4px; text-align: center;"> 
                        <img src="{{ public_path('images/selo_br_pb.png') }}" alt="Logo" style="height:80px;">
                    </td>
                    <td colspan="1" style="padding: 4px; text-align: center;">
                        <strong>{{ "REPÚBLICA FEDERATIVA DO BRASIL" }}<br>{{ "ESTADO DO RIO GRANDE DO SUL" }}<br>{{ "SECRETARIA DE ESTADO DA EDUCAÇÃO" }}</strong>
                    </td>
                    <td style="padding: 4px; text-align: center;">
                        <img src="{{ public_path('images/selo_rs_pb.png') }}" alt="Logo" style="height:90px;">
                    </td>
                </tr>
        </table>
        </div>
        <div class="row mb-2">
            <table border="0" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 4px;font-size: 10px; text-align: center;">
                        <strong>{{ $niche_company_name }}</strong><br>
                        <small>
                            {{ $niche_street }}, {{ $niche_number }} (Bairro {{ $niche_neighborhood }}) - CEP: {{ $niche_zip }} - {{ $niche_city }} - {{ $niche_state }}<br>
                            {{ "Celular: " . $niche_cellphone . " | WhatsApp: " . $niche_whatsapp }} <br>
                            CNPJ: {{ $niche_cnpj }} {{ " - Entidade Mantenedora: Secretaria de Educação - 1º CRE"}}<br>  
                            <strong>{{ "Criação: " . $niche_foundation }}</strong><br>
                            <strong>{{ "Autorização: " .  $niche_authorization1 }}</strong><br>
                            {{ $niche_authorization2 }}
                        </small>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row mb-2">
            <h2 style="padding: 4px; text-align:center;">
                @if ($nivelEnsino=="EMAF")
                        @if($conclusionCertificationEMAF == "Cursando")
                            {{ "CERTIFICADO DE CONCLUSÃO PARCIAL" }}
                        @else
                            {{ "CERTIFICADO DE CONCLUSÃO" }}
                        @endif
                        <br> {{ "ENSINO MÉDIO" }}
                @elseif ($nivelEnsino=="EFSF")
                        @if($conclusionCertificationEFSF == "Cursando")
                            {{ "CERTIFICADO DE CONCLUSÃO PARCIAL" }}
                        @else
                            {{ "CERTIFICADO DE CONCLUSÃO" }}
                        @endif                    
                    <br> {{ "ENSINO FUNDAMENTAL ANOS FINAIS" }}
                @elseif ($nivelEnsino=="EFSI")
                        @if($conclusionCertificationEFSI == "Cursando")
                            {{ "CERTIFICADO DE CONCLUSÃO PARCIAL" }}
                        @else
                            {{ "CERTIFICADO DE CONCLUSÃO" }}
                        @endif                    
                    <br> {{ "ENSINO FUNDAMENTAL ANOS INICIAIS" }}
                @endif
            </h2>
        </div>
        <div class="row mb-2">
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="padding: 4px;"> 
                        {{'Nome do Aluno: ' }}<strong>{{ $userData->name }}</strong><br>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px;"> 
                        {{'Filho de: ' }}{{ $user_father }}
                    </td>
                    <td style="padding: 4px;">
                        {{'e de: ' }}{{ $user_mother }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px;"> 
                        {{'Natural de: ' }}{{ $user_birthplace }}
                    </td>
                    <td style="padding: 4px;">
                        {{'Estado: ' }}{{ $user_state }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px;"> 
                        {{'Nacionalidade: ' }}{{ $user_nationality }}
                    </td>
                    <td style="padding: 4px;">
                        {{'Data de nascimento: ' }}{{ \Carbon\Carbon::parse($user_birth)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 4px;"> 
                        {{'Documento: ' }}{{ $user_doc_number }} 
                    </td>
                    <td style="padding: 4px;">
                        {{' Tipo: ' }}{{ $user_type }} 
                    </td>
                </tr>
                <tr>
                    <td  style="padding: 4px;"> 
                        {{' Emitido por: ' }}{{ $user_issuer }}
                        {{' Em: ' }}{{ \Carbon\Carbon::parse($user_issue_date)->format('d/m/Y') }}
                    </td>
                    <td style="padding: 4px;">
                        {{' Validade: ' }}{{ \Carbon\Carbon::parse($user_valid_to)->format('d/m/Y') }}
                    </td>
                </tr>
            </table>
        </div>

        <p class="text-justify">
            @php
                $concluido = "concluiu";
                if ($nivelEnsino == "EFSI") {
                    $anoConclusao = $conclusionCertificationEFSI;
                } elseif ($nivelEnsino == "EFSF") {
                    $anoConclusao = $conclusionCertificationEFSF;
                } else {
                    $anoConclusao = $conclusionCertificationEMAF;
                }

                if ($anoConclusao == "Cursando") {
                    $concluido = "está cursando";
                    $anoConclusao = \Carbon\Carbon::now()->format('Y');
                }
            @endphp
            @if ($nivelEnsino=="EMAF") 
                Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Médio de Educação de Jovens e Adultos Anos Finais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
            @elseif ($nivelEnsino=="EFSF")
                    Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Fundamental de Educação de Jovens e Adultos Séries Finais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
            @elseif ($nivelEnsino=="EFSI")
                Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Fundamental de Educação de Jovens e Adultos Séries Iniciais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
            @endif
        </p>

        <div class="row mb-2">
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 4px;" colspan="4" class="text-center bg-info text-white">Áreas do Conhecimento</th>
                    </tr>
                    <tr>
                        <th style="padding: 4px; width:280px;"></th>
                        <th style="padding: 4px; width:70px; text-align:center;">Resultado</th>
                        <th style="padding: 4px;width:70px; text-align:center;">Conclusão</th>
                        <th style="padding: 4px;">Observação</th>
                    </tr>
                </thead>
                @if ($nivelEnsino=="EMAF")
                <tbody> 
                    <tr>
                        <td style="padding: 4px; width:280px;"><strong>{{ $ak1EMAFName}}</strong><BR><small>{{ $ak1EMAFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EMAFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EMAFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak1EMAFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; width:280px;"><strong>{{ $ak2EMAFName}}</strong><BR><small>{{ $ak2EMAFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak2EMAFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak2EMAFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak2EMAFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; width:280px;"><strong>{{ $ak3EMAFName}}</strong><BR><small>{{ $ak3EMAFDescription }}</small></td>
                        <td style="padding: 4px ; width:70px; text-align:center;">{{ $ak3EMAFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak3EMAFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak3EMAFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; width:280px;"><strong>{{ $ak4EMAFName}}</strong><BR><small>{{ $ak4EMAFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak4EMAFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak4EMAFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak4EMAFObs }}</small></td>
                    </tr>
                </tbody>
                @elseif ($nivelEnsino=="EFSF")
                <tbody>
                    <tr>
                        <td style="padding: 4px; width:220px;"><strong>{{ $ak1EFSFName}}</strong><BR><small>{{ $ak1EFSFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EFSFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EFSFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak1EFSFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; width:220px;"><strong>{{ $ak2EFSFName}}</strong><BR><small>{{ $ak2EFSFDescription }}</small></td>
                        <td style="padding: 4px ; width:70px; text-align:center;">{{ $ak2EFSFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak2EFSFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak2EFSFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; width:220px;"><strong>{{ $ak3EFSFName}}</strong><BR><small>{{ $ak3EFSFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak3EFSFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak3EFSFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak3EFSFObs }}</small></td>
                    </tr>
                    <tr>
                        <td style="padding: 4px; width:220px;"><strong>{{ $ak4EFSFName}}</strong><BR><small>{{ $ak4EFSFDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak4EFSFResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak4EFSFConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak4EFSFObs }}</small></td>
                    </tr>
                </tbody>
               @elseif ($nivelEnsino=="EFSI")
                <tbody>
                    <tr>
                        <td style="padding: 4px; width:220px;"><strong>{{ $ak1EFSIName}}</strong><BR><small>{{ $ak1EFSIDescription }}</small></td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EFSIResult }}</td>
                        <td style="padding: 4px; width:70px; text-align:center;">{{ $ak1EFSIConclusion }}</td>
                        <td style="padding: 4px;"><small>{{ $ak1EFSIObs }}</small></td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>

        <div class="row mb-2">
        <table border="0" style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 4px;" colspan="3" class="text-center bg-info text-white">
                    <p' style="padding: 4px; text-align:center;">
                        {{ "Porto Alegre," }}
                        {{ \Carbon\Carbon::now()->format('d') }}
                        {{ "de" }}
                        {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('F') }}                    {{ "de" }}
                        {{ \Carbon\Carbon::now()->format('Y') }}{{"."}}
                    </p> 
                </td>
            </tr>
                    <tr>
                        <td style="padding: 4px;"> 
                            <h6 style="padding: 4px; text-align:center;">
                                <BR><BR>
                                {{ "_________________________________________" }}<BR>
                                {{ "Adriana Pereira Correa" }}<BR>
                                {{ "Agente Educacional III" }}<BR>
                                {{ "ID Funcional: 1816551" }}<BR>

                            </h6>
                       </td>
                        <td colspan="1" style="padding: 4px;">
                        </td>
                        <td style="padding: 4px;">
                            <h6 style="padding: 4px; text-align:center;">
                                <BR><BR>
                                {{ "_________________________________________" }}<BR>
                                {{ "Marlei Silva de Andrade" }}<BR>
                                {{ "Diretora" }}<BR>
                                {{ "ID Funcional: 2455277/01" }}<BR>
                            </h6>
                        </td>
                    </tr>
        </table>
        </div>

    </body>
</html>
