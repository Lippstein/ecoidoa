@php
    $matriculadoEm = isset($userDataFlex->created_at) ? $userDataFlex->created_at : '';
    $atualizadoEm = isset($userDataFlex->updated_at) ? $userDataFlex->updated_at : '';
    $data = $userDataFlex->user_profile;
    if (is_string($data)) {
        try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
    }
    $iseNumber = isset($data['iseNumber']) ? $data['iseNumber'] : '0';

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
    $user_social_name = isset($user_dataDoc['social_name']) ? $user_dataDoc['social_name'] : '';
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
    $user_gender_identity = isset($user_dataDoc['gender']) ? $user_dataDoc['gender'] : '';

    $profile_image = isset($user_dataDoc['profile_image']) ? $user_dataDoc['profile_image'] : '';

@endphp

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>{{ $title ?? 'Boletim' }}</title>
        <style>
                @page { size: A4 landscape; margin: 12mm; }
                body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        </style>
    </head>

    <body>
        <table border="0" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
            <colgroup>
                <col style="width:47%;">
                <col style="width:6%;">
                <col style="width:47%;">
            </colgroup>
            <tr>
               <td style="vertical-align: top; padding: 8px; width: 47%;">
                    <div class="row mb-2">
                        <p>INFORMAÇÕES IMPORTANTES</p>
                        <p>A) O aluno deve apresentar este boletim com foto para realização de provas e atendimento em qualquer dos setores da Escola.</p>
                        <p>B) Leia os cartazes informativos afixados na escola.</p>
                        <p>C) Verifique e copie os horários de atendimento da escola.</p>
                        <p>D) Lembre-se: O NEEJA-CP Darcy Vargas certifica somente a conclusão da Área do Conhecimento.</p>
                        <p>E) Este documento é importante. Em caso de perda, um novo deverá ser providenciado pelo NEEJA-CP Darcy Vargas.</p>
 
                        <table border="1" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br>{!! 'Observações:' !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br><hr> <br>
                                </td>
                            </tr>
                        </table>
                    </div>
               </td>

               <td style="vertical-align: top; padding: 8px; width: 6%;">
               </td>

                <td style="vertical-align: top; padding: 8px; width: 47%;">
                    <div class="row mb-2">
                        <table border="0" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 4px; text-align: center;"> 
                                    <img src="{{ public_path('images/logoneejacpdv.png') }}" alt="Logo" style="height:80px;">
                                </td>
                                <td colspan="1" style="padding: 4px; text-align: center;">
                                    <strong>{{ "REPÚBLICA FEDERATIVA DO BRASIL" }}<br>{{ "ESTADO DO RIO GRANDE DO SUL" }}<br>{{ "SECRETARIA DE ESTADO DA EDUCAÇÃO" }}</strong>
                                </td>
                                <td style="padding: 4px; text-align: center;">
                                    <img src="{{ public_path('storage/' . $profile_image) }}" alt="Logo" style="height:80px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row mb-2">
                        <table border="0" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 0px;font-size: 10px; text-align: center;">
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
                        @if($conclusionCertificationEMAF == "Cursando")
                            <?php $boletim = "BOLETIM<br>ENSINO MÉDIO"; ?>
                        @endif
                        @if($conclusionCertificationEFSF == "Cursando")
                            <?php $boletim = "BOLETIM<br>ENSINO FUNDAMENTAL ANOS FINAIS"; ?>
                        @endif
                        @if($conclusionCertificationEFSI == "Cursando")
                            <?php $boletim = "BOLETIM<br>ENSINO FUNDAMENTAL ANOS INICIAIS"; ?>
                        @endif
                        <h2 style="padding: 4px; text-align:center;">
                            {!! $boletim !!}
                        </h2>
                    </div>
                    <div class="row mb-2">
                        <table border="1" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="padding: 4px;">    </td>

                            </tr>
                            <tr>
                                @if ($user_social_name!="")
                                    <td colspan="2" style="padding: 4px;">{{'Nome Social: ' }}<strong>{{ $user_social_name }}</strong></td>
                                @else
                                    @if ($user_gender_identity=="Masculino")
                                        <td colspan="2" style="padding: 4px;">{{'Nome do Aluno: ' }}<strong>{{ $userData->name }}</strong></td>
                                    @elseif ($user_gender_identity=="Feminino")
                                        <td colspan="2" style="padding: 4px;">{{'Nome da Aluna: ' }}<strong>{{ $userData->name }}</strong></td>
                                    @else
                                        <td colspan="2" style="padding: 4px;">{{'Nome: ' }}<strong>{{ $userData->name }}</strong></td>
                                    @endif
                                @endif
                            </tr>
                            <tr>
                                <td style="padding: 4px;"> 
                                    {{'Documento: ' }}{{ $user_type }} 
                                </td>
                                <td style="padding: 4px;">
                                    {{'Número: ' }}{{ $user_doc_number }} 
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 4px;"> 
                                    {{' CPF: ' }}{{ $user_cpf }} 
                                </td>
                                <td style="padding: 4px;"> 
                                    {{' Número ISE: ' }} {{ $iseNumber }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 4px;"> 
                                    {{' Data de Matrícula: ' }} {{ \Carbon\Carbon::parse($matriculadoEm)->format('d/m/Y') }}
                                </td>
                                <td style="padding: 4px;">
                                    {{' Atualizado em: ' }} {{ \Carbon\Carbon::parse($atualizadoEm)->format('d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <br>
                                    <p align="center">{{ "______________________________________________________" }}<br>
                                    @if ($user_gender_identity=="Masculino")
                                        {{'Assinatura do Aluno' }}
                                    @elseif ($user_gender_identity=="Feminino")
                                        {{'Assinatura da Aluna' }}
                                    @else
                                        {{'Assinatura do(a) Aluno(a)' }}
                                    @endif</p>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="row mb-2">
                        <table border="0" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                            <colgroup>
                                <col style="width:49%;">
                                <col style="width:2%;">
                                <col style="width:49%;">
                            </colgroup>
                            <tr>
                                <td style="padding: 4px;" colspan="3" class="text-center bg-info text-white">
                                    <p style="padding: 4px; text-align:center;">
                                        {{ "Porto Alegre," }}
                                        {{ \Carbon\Carbon::now()->format('d') }}
                                        {{ "de" }}
                                        {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('F') }}                    {{ "de" }}
                                        {{ \Carbon\Carbon::now()->format('Y') }}{{"."}}
                                    </p> 
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 2px; width:49%;"> 
                                    <p style="text-align:center;"><small>
                                        <BR>
                                        {{-- {{ "_________________________________________" }}<BR> --}}
                                        <strong>{{ "Adriana Pereira Correa" }}</strong><BR>
                                        {{ "Agente Educacional III" }}<BR>
                                        {{ "ID Funcional: 1816551" }}<BR>

                                    </small></p>
                                </td>
                                <td style="padding: 2px; width:2%;">
                                </td>
                                <td style="padding: 2px; width:49%;">
                                    <p style="text-align:center;"><small>
                                        <BR>
                                        {{-- {{ "_________________________________________" }}<BR> --}}
                                        <strong>{{ "Marlei Silva de Andrade" }}</strong><BR>
                                        {{ "Diretora" }}<BR>
                                        {{ "ID Funcional: 2455277/01" }}<BR>
                                    </small></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>




        <table border="0" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
            <colgroup>
                <col style="width:47%;">
                <col style="width:6%;">
                <col style="width:47%;">
            </colgroup>
            <tr>
               <td style="vertical-align: top; padding: 8px; width: 47%;">
                    <div class="row mb-2">
                        <p align="center"><strong>ÁREA DO CONHECIMENTO: ENSINO FUNDAMENTAL</strong></p>
                        <p><small>Classificado(a) / Reclassificado(a) para concluir os Componentes Curriculares abaixo: </small><p>
                        <table border="1" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                            <tr style="background-color: #80eeee;">
                                <td style="padding: 2px; border: 1px solid #000; text-align: center;" colspan="7" class="text-center bg-info text-white"><strong>{{ $certificationEFSI }}</strong></td>
                            </tr>
                                @if ($conclusionCertificationEFSI!="Cursando")
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><small>Componente</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Resultado</small></td>
                                        <td style="padding: 2px;width:50px; text-align:center; border: 1px solid #000;"><small>Conclusão</small></td>
                                        <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>Observação</small></td>
                                    </tr>
                                
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><small><strong>{{ $ak1EFSIName}}</strong><br>{{ $ak1EFSIDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EFSIResult }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EFSIConclusion }}</small></td>
                                        <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak1EFSIObs }}</small></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;">Componente</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak1EFSIName}}</strong><BR><small>{{ $ak1EFSIDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @endif
                        </table>
                        <br>
                        <table border="1" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                            <tr style="background-color: #80eeee;">
                                <td style="padding: 2px; border: 1px solid #000; text-align: center;" colspan="7" class="text-center bg-info text-white"><strong>{{ $certificationEFSF }}</strong></td>
                            </tr>
                            @if ($conclusionCertificationEFSF != "Cursando")
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;"><small>Componente</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Resultado</small></td>
                                    <td style="padding: 2px;width:50px; text-align:center; border: 1px solid #000;"><small>Conclusão</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>Observação</small></td>
                                </tr>                                
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;"><small><strong>{{ $ak1EFSFName}}</strong><br>{{ $ak1EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EFSFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EFSFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak1EFSFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;"><small><strong>{{ $ak2EFSFName}}</strong><br>{{ $ak2EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EFSFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EFSFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak2EFSFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;"><small><strong>{{ $ak3EFSFName}}</strong><br>{{ $ak3EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EFSFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EFSFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak3EFSFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;"><small><strong>{{ $ak4EFSFName}}</strong><br>{{ $ak4EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EFSFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EFSFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak4EFSFObs }}</small></td>
                                </tr>
                            @else
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:120px; border: 1px solid #000;">Componente</td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                </tr>
                                @if($ak1EFSFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak1EFSFName}}</strong><BR><small>{{ $ak1EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak1EFSFName}}</strong><BR><small>{{ $ak1EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EFSFConclusion }}</small><br><small>{{ $ak1EFSFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak2EFSFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak2EFSFName}}</strong><small>{{ $ak2EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak2EFSFName}}</strong><BR><small>{{ $ak2EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EFSFConclusion }}</small><br><small>{{ $ak2EFSFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak3EFSFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak3EFSFName}}</strong><BR><small>{{ $ak3EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak3EFSFName}}</strong><BR><small>{{ $ak3EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EFSFConclusion }}</small><br><small>{{ $ak3EFSFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak4EFSFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak4EFSFName}}</strong><BR><small>{{ $ak4EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:120px; border: 1px solid #000;"><strong>{{ $ak4EFSFName}}</strong><BR><small>{{ $ak4EFSFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EFSFConclusion }}</small><br><small>{{ $ak4EFSFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                            @endif
                        </table>
                        <BR>
                        <table border="1" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    {!! 'Observações:' !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </div>
               </td>

               <td style="vertical-align: top; padding: 8px; width: 6%;">
               </td>


               <td style="vertical-align: top; padding: 8px; width: 47%;">
                    <div class="row mb-2">
                        <p align="center"><strong>ÁREA DO CONHECIMENTO: ENSINO MÉDIO</strong></p>
                        <p><small>Classificado(a) / Reclassificado(a) para concluir os Componentes Curriculares abaixo: </small><p>
                        <table border="1" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                            <tr style="background-color: #80eeee;">
                                <td style="padding: 2px; border: 1px solid #000; text-align: center;" colspan="7" class="text-center bg-info text-white"><strong>{{ $certificationEMAF }}</strong></td>
                            </tr>
                            @if ($conclusionCertificationEMAF != "Cursando")
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;"><small>Componente</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Resultado</small></td>
                                    <td style="padding: 2px;width:50px; text-align:center; border: 1px solid #000;"><small>Conclusão</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>Observação</small></td>
                                </tr>                                
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;"><small><strong>{{ $ak1EMAFName}}</strong><br>{{ $ak1EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EMAFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EMAFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak1EMAFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;"><small><strong>{{ $ak2EMAFName}}</strong><br>{{ $ak2EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EMAFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EMAFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak2EMAFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;"><small><strong>{{ $ak3EMAFName}}</strong><br>{{ $ak3EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EMAFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EMAFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak3EMAFObs }}</small></td>
                                </tr>
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;"><small><strong>{{ $ak4EMAFName}}</strong><br>{{ $ak4EFSFDescription }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EMAFResult }}</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EMAFConclusion }}</small></td>
                                    <td colspan="4" style="padding: 2px; border: 1px solid #000;"><small>{{ $ak4EMAFObs }}</small></td>
                                </tr>
                            @else
                                <tr style="background-color: #80eeee;">
                                    <td style="padding: 2px; width:137px; border: 1px solid #000;">Componente</td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                    <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>Data<br>APR/REP</small></td>
                                    <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"><small>Rúb.<br>Prof.</small></td>
                                </tr>
                                @if($ak1EMAFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak1EMAFName}}</strong><BR><small>{{ $ak1EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak1EMAFName}}</strong><BR><small>{{ $ak1EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak1EMAFConclusion }}</small><br><small>{{ $ak1EMAFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak2EMAFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak2EMAFName}}</strong><BR><small>{{ $ak2EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak2EMAFName}}</strong><BR><small>{{ $ak2EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak2EMAFConclusion }}</small><br><small>{{ $ak2EMAFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak3EMAFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak3EMAFName}}</strong><BR><small>{{ $ak3EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak3EMAFName}}</strong><BR><small>{{ $ak3EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak3EMAFConclusion }}</small><br><small>{{ $ak3EMAFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                                @if($ak4EMAFConclusion == "")
                                    <tr>
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak4EMAFName}}</strong><BR><small>{{ $ak4EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">___/___/___<br>_____</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;"></td>
                                    </tr>
                                @else
                                    <tr style="background-color: #80eeee;">
                                        <td style="padding: 2px; width:137px; border: 1px solid #000;"><strong>{{ $ak4EMAFName}}</strong><BR><small>{{ $ak4EMAFDescription }}</small></td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;"><small>{{ $ak4EMAFConclusion }}</small><br><small>{{ $ak4EMAFResult }}</small></td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:50px; text-align:center; border: 1px solid #000;">X</td>
                                        <td style="padding: 2px; width:37px; text-align:center; border: 1px solid #000;">X</td>
                                    </tr>
                                @endif
                            @endif
                        </table>
                        <BR>
                        <table border="1" style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    {!! 'Observações:' !!}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 4px;"> 
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </div>
               </td>
            </tr>
        </table>
    </body>
</html>

























                    {{-- <p class="text-justify"> --}}
                        {{-- @php
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
                        @endphp --}}
                        {{-- @if ($nivelEnsino=="EMAF") 
                            Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Médio de Educação de Jovens e Adultos Anos Finais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
                        @elseif ($nivelEnsino=="EFSF")
                                Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Fundamental de Educação de Jovens e Adultos Séries Finais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
                        @elseif ($nivelEnsino=="EFSI")
                            Certificamos que <strong>{{ $userData->name }}</strong>, {{ $concluido }} o Ensino Fundamental de Educação de Jovens e Adultos Séries Iniciais no ano de <strong>{{ $anoConclusao }}</strong>, de acordo com a Lei Federal Nº 9.394 de 20 de dezembro de de 1996 e com o disposto no Regimento Escolar, tendo obtido os seguintes resultados constantes neste Histórico de Conclusão.
                        @endif
                    {{-- </p> --}}

                    {{-- <div class="row mb-2">
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
                    </div> --}}













