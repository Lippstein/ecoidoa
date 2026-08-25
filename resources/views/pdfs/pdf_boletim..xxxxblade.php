@extends("layouts.app")
{{-- @section('title', 'Usuário - Idoa') --}}
@section("content")
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Visualizar Perfil do Usuário </h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info">Voltar Lista Perfis</a>
    </div>
    <div class="row mb-2">
        <div>
            Perfil (ID): <strong> {{ $userDataFlex->id }} </strong> - Habitat_ID: <strong> {{ $userDataFlex->habitat_id }} </strong> - Niche_ID: <strong> {{ $userDataFlex->niche_id }} </strong>
        </div>        
        <div>
            {{-- Nome do Usuário: <strong>{{ $user->name }}</strong> - User_ID: <strong> {{ $userDataFlex->user_id }} </strong> --}}
        </div>
        <div>
            Data de Cadastro:<strong>{{ \Carbon\Carbon::parse($userDataFlex->created_at)->format('d/m/Y H:i:s') }}</strong>
            - Data de Atualização:<strong>{{ \Carbon\Carbon::parse($userDataFlex->updated_at)->format('d/m/Y H:i:s') }}</strong>
        </div>
    </div>
    @php
        $data = $userDataFlex->user_profile;
        if (is_string($data)) {
            try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
        }
        $certificationEFSI = isset($data['certificationEFSI']) ? $data['certificationEFSI'] : 'Certificação-EFSI não cadastrada'; 
        $conclusionCertificationEFSI = isset($data['conclusionCertificationEFSI']) ? $data['conclusionCertificationEFSI'] : 'Cursando'; 
        $ak1EFSIName = isset($data['ak1EFSIName']) ? $data['ak1EFSIName'] : 'Nome AK1 não cadastrado';
        $ak1EFSIDescription = isset($data['ak1EFSIDescription']) ? $data['ak1EFSIDescription'] : 'Descrição AK1 não cadastrada';
        $ak1EFSIResult = isset($data['ak1EFSIResult']) ? $data['ak1EFSIResult'] : 'Resultado AK1 não cadastrado';
        $ak1EFSIConclusion = isset($data['ak1EFSIConclusion']) ? $data['ak1EFSIConclusion'] : 'Conclusão AK1 não cadastrada';
        $ak1EFSIObs = isset($data['ak1EFSIObs']) ? $data['ak1EFSIObs'] : 'Observação AK1 não cadastrada';

        $certificationEFSF = isset($data['certificationEFSF']) ? $data['certificationEFSF'] : 'Certificação-EFSF não cadastrada';
        $conclusionCertificationEFSF = isset($data['conclusionCertificationEFSF']) ? $data['conclusionCertificationEFSF'] : 'Cursando';
        $ak1EFSFName = isset($data['ak1EFSFName']) ? $data['ak1EFSFName'] : 'Nome AK1 não cadastrado';
        $ak1EFSFDescription = isset($data['ak1EFSFDescription']) ? $data['ak1EFSFDescription'] : 'Descrição AK1 não cadastrada';
        $ak1EFSFResult = isset($data['ak1EFSFResult']) ? $data['ak1EFSFResult'] : 'Resultado AK1 não cadastrado';
        $ak1EFSFConclusion = isset($data['ak1EFSFConclusion']) ? $data['ak1EFSFConclusion'] : 'Conclusão AK1 não cadastrada';
        $ak1EFSFObs = isset($data['ak1EFSFObs']) ? $data['ak1EFSFObs'] : 'Observação AK1 não cadastrada';
        $ak2EFSFName = isset($data['ak2EFSFName']) ? $data['ak2EFSFName'] : 'Nome AK2 não cadastrado';
        $ak2EFSFDescription = isset($data['ak2EFSFDescription']) ? $data['ak2EFSFDescription'] : 'Descrição AK2 não cadastrada';
        $ak2EFSFResult = isset($data['ak2EFSFResult']) ? $data['ak2EFSFResult'] : 'Resultado AK2 não cadastrado';
        $ak2EFSFConclusion = isset($data['ak2EFSFConclusion']) ? $data['ak2EFSFConclusion'] : 'Conclusão AK2 não cadastrada';
        $ak2EFSFObs = isset($data['ak2EFSFObs']) ? $data['ak2EFSFObs'] : 'Observação AK2 não cadastrada';
        $ak3EFSFName = isset($data['ak3EFSFName']) ? $data['ak3EFSFName'] : 'Nome AK3 não cadastrado';
        $ak3EFSFDescription = isset($data['ak3EFSFDescription']) ? $data['ak3EFSFDescription'] : 'Descrição AK3 não cadastrada';
        $ak3EFSFResult = isset($data['ak3EFSFResult']) ? $data['ak3EFSFResult'] : 'Resultado AK3 não cadastrado';        
        $ak3EFSFConclusion = isset($data['ak3EFSFConclusion']) ? $data['ak3EFSFConclusion'] : 'Conclusão AK3 não cadastrada';
        $ak3EFSFObs = isset($data['ak3EFSFObs']) ? $data['ak3EFSFObs'] : 'Observação AK3 não cadastrada';
        $ak4EFSFName = isset($data['ak4EFSFName']) ? $data['ak4EFSFName'] : 'Nome AK4 não cadastrado';
        $ak4EFSFDescription = isset($data['ak4EFSFDescription']) ? $data['ak4EFSFDescription'] : 'Descrição AK4 não cadastrada';
        $ak4EFSFResult = isset($data['ak4EFSFResult']) ? $data['ak4EFSFResult'] : 'Resultado AK4 não cadastrado';
        $ak4EFSFConclusion = isset($data['ak4EFSFConclusion']) ? $data['ak4EFSFConclusion'] : 'Conclusão AK4 não cadastrada';
        $ak4EFSFObs = isset($data['ak4EFSFObs']) ? $data['ak4EFSFObs'] : 'Observação AK4 não cadastrada';

        $certificationEMAF = isset($data['certificationEMAF']) ? $data['certificationEMAF'] : 'Certificação-EMAF não cadastrada';
        $conclusionCertificationEMAF = isset($data['conclusionCertificationEMAF']) ? $data['conclusionCertificationEMAF'] : 'Cursando';
        $ak1EMAFName = isset($data['ak1EMAFName']) ? $data['ak1EMAFName'] : 'Nome AK1 não cadastrado';
        $ak1EMAFDescription = isset($data['ak1EMAFDescription']) ? $data['ak1EMAFDescription'] : 'Descrição AK1 não cadastrada';
        $ak1EMAFResult = isset($data['ak1EMAFResult']) ? $data['ak1EMAFResult'] : 'Resultado AK1 não cadastrado';
        $ak1EMAFConclusion = isset($data['ak1EMAFConclusion']) ? $data['ak1EMAFConclusion'] : 'Conclusão AK1 não cadastrada';
        $ak1EMAFObs = isset($data['ak1EMAFObs']) ? $data['ak1EMAFObs'] : 'Observação AK1 não cadastrada';
        $ak2EMAFName = isset($data['ak2EMAFName']) ? $data['ak2EMAFName'] : 'Nome AK2 não cadastrado';
        $ak2EMAFDescription = isset($data['ak2EMAFDescription']) ? $data['ak2EMAFDescription'] : 'Descrição AK2 não cadastrada';
        $ak2EMAFResult = isset($data['ak2EMAFResult']) ? $data['ak2EMAFResult'] : 'Resultado AK2 não cadastrado ';
        $ak2EMAFConclusion = isset($data['ak2EMAFConclusion']) ? $data['ak2EMAFConclusion'] : 'Conclusão AK2 não cadastrada';
        $ak2EMAFObs = isset($data['ak2EMAFObs']) ? $data['ak2EMAFObs'] : 'Observação AK2 não cadastrada';
        $ak3EMAFName = isset($data['ak3EMAFName']) ? $data['ak3EMAFName'] : 'Nome AK3 não cadastrado';
        $ak3EMAFDescription = isset($data['ak3EMAFDescription']) ? $data['ak3EMAFDescription'] : 'Descrição AK3 não cadastrada';
        $ak3EMAFResult = isset($data['ak3EMAFResult']) ? $data['ak3EMAFResult'] : 'Resultado AK3 não cadastrado';        
        $ak3EMAFConclusion = isset($data['ak3EMAFConclusion']) ? $data['ak3EMAFConclusion'] : 'Conclusão AK3 não cadastrada';
        $ak3EMAFObs = isset($data['ak3EMAFObs']) ? $data['ak3EMAFObs'] : 'Observação AK3 não cadastrada';
        $ak4EMAFName = isset($data['ak4EMAFName']) ? $data['ak4EMAFName'] : 'Nome AK4 não cadastrado';
        $ak4EMAFDescription = isset($data['ak4EMAFDescription']) ? $data['ak4EMAFDescription'] : 'Descrição AK4 não cadastrada';
        $ak4EMAFResult = isset($data['ak4EMAFResult']) ? $data['ak4EMAFResult'] : 'Resultado AK4 não cadastrado';
        $ak4EMAFConclusion = isset($data['ak4EMAFConclusion']) ? $data['ak4EMAFConclusion'] : 'Conclusão AK4 não cadastrada';
        $ak4EMAFObs = isset($data['ak4EMAFObs']) ? $data['ak4EMAFObs'] : 'Observação AK4 não cadastrada';

        // $street = isset($data['street']) ? $data['street'] : 'Rua não cadastrada';
        // $number = isset($data['number']) ? $data['number'] : 'Número não cadastrado';
        // $city = isset($data['city']) ? $data['city'] : 'Cidade não cadastrada';
        // $state = isset($data['state']) ? $data['state'] : 'Estado não cadastrado';
        // $zip = isset($data['zip']) ? $data['zip'] : 'CEP não cadastrado';
        // $country = isset($data['country']) ? $data['country'] : 'Brasil';
        // $cellphone = isset($data['cellphone']) ? $data['cellphone'] : 'Celular não cadastrado';
        // $phone = isset($data['phone']) ? $data['phone'] : 'Telefone não cadastrado';
        // $whatsapp = isset($data['whatsapp']) ? $data['whatsapp'] : 'WhatsApp não cadastrado';
        // $telegram = isset($data['telegram']) ? $data['telegram'] : 'Telegram não cadastrado';
        // $facebook = isset($data['facebook']) ? $data['facebook'] : 'Facebook não cadastrado';
        // $instagram = isset($data['instagram']) ? $data['instagram'] : 'Instagram não cadastrado';
    @endphp
    <div class="py-2 mb-4 rounded">
        <h6 class="text-center">Perfil do Usuário</h6>
        <hr style="margin:8px 0; opacity:.3;">
    </div>

        <div class="row mb-2">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead
                <tr>
                    <th colspan="3" class="text-center bg-info text-white">Certificação</th>
                    <th colspan="1" class="text-center bg-info text-white">Conclusão</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 8px;">{{ $certificationEFSI }}</td>
                    <td colspan="1" style="padding: 8px;">{{ $conclusionCertificationEFSI }}
                        @if($conclusionCertificationEFSI != "Cursando")
                            <a href="{{ route('pdf.historico', ['id' => $userDataFlex->id, 'nivelEnsino' => 'EFSI']) }}" class="btn btn-warning">Histórico</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="4" class="text-center bg-info text-white">Áreas do Conhecimento</th>
                </tr>
                <tr>
                    <th>Área</th>
                    <th>Resultado</th>
                    <th>Conclusão</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">{{ $ak1EFSIName}}<BR><small>{{ $ak1EFSIDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak1EFSIResult }}</td>
                    <td style="padding: 8px;">{{ $ak1EFSIConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak1EFSIObs }}</small></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="row mb-2">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead
                <tr>
                    <th colspan="3" class="text-center bg-primary text-white">Certificação</th>
                    <th colspan="1" class="text-center bg-primary text-white">Conclusão</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 8px;">{{ $certificationEFSF }}</td>
                    <td colspan="1" style="padding: 8px;">{{ $conclusionCertificationEFSF }}
                        @if($conclusionCertificationEFSF != "Cursando")
                            <a href="{{ route('pdf.historico', ['id' => $userDataFlex->id, 'nivelEnsino' => 'EFSF']) }}" class="btn btn-warning">Histórico</a>
                        @endif                    
                    </td>
                </tr>
                <tr>
                    <th colspan="4" class="text-center bg-primary text-white">Áreas do Conhecimento</th>
                </tr>
                <tr>
                    <th>Área</th>
                    <th>Resultado</th>
                    <th>Conclusão</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">{{ $ak1EFSFName}}<BR><small>{{ $ak1EFSFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak1EFSFResult }}</td>
                    <td style="padding: 8px;">{{ $ak1EFSFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak1EFSFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak2EFSFName }}<BR><small>{{ $ak2EFSFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak2EFSFResult }}</td>
                    <td style="padding: 8px;">{{ $ak2EFSFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak2EFSFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak3EFSFName }}<BR><small>{{ $ak3EFSFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak3EFSFResult }}</td>
                    <td style="padding: 8px;">{{ $ak3EFSFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak3EFSFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak4EFSFName }}<BR><small>{{ $ak4EFSFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak4EFSFResult }}</td>
                    <td style="padding: 8px;">{{ $ak4EFSFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak4EFSFObs }}</small></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row mb-2">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead
                <tr>
                    <th colspan="3" class="text-center bg-success text-white">Certificação</th>
                    <th colspan="1" class="text-center bg-success text-white">Conclusão</th>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 8px;">{{ $certificationEMAF }}</td>
                    <td colspan="1" style="padding: 8px;">{{ $conclusionCertificationEMAF }}
                        @if($conclusionCertificationEMAF != "Cursando")
                            <a href="{{ route('pdf.historico', ['id' => $userDataFlex->id, 'nivelEnsino' => 'EMAF']) }}" class="btn btn-warning">Histórico</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="4" class="text-center bg-success text-white">Áreas do Conhecimento</th>
                </tr>
                <tr>
                    <th>Área</th>
                    <th>Resultado</th>
                    <th>Conclusão</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">{{ $ak1EMAFName}}<BR><small>{{ $ak1EMAFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak1EMAFResult }}</td>
                    <td style="padding: 8px;">{{ $ak1EMAFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak1EMAFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak2EMAFName }}<BR><small>{{ $ak2EMAFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak2EMAFResult }}</td>
                    <td style="padding: 8px;">{{ $ak2EMAFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak2EMAFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak3EMAFName }}<BR><small>{{ $ak3EMAFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak3EMAFResult }}</td>
                    <td style="padding: 8px;">{{ $ak3EMAFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak3EMAFObs }}</small></td>
                </tr>
                <tr>
                    <td style="padding: 8px;">{{ $ak4EMAFName }}<BR><small>{{ $ak4EMAFDescription }}</small></td>
                    <td style="padding: 8px;">{{ $ak4EMAFResult }}</td>
                    <td style="padding: 8px;">{{ $ak4EMAFConclusion }}</td>
                    <td style="padding: 8px;"><small>{{ $ak4EMAFObs }}</small></td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info">Voltar Lista Perfis</a>
    </div>
</div>
@endsection