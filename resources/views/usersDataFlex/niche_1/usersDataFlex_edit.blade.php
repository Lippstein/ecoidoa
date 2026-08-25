@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">CENTRAL DE MATRÍCULA - HISTÓRICO</h4>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('users_edit_neejacpdv.show', [$userDataFlex->user_id, $userDataFlex->niche_id]) }}" class="btn btn-warning btn-md fw-bold px-4 me-2">Dados do Cadastro</a>
            <button type="button" class="btn btn-warning btn-md px-4 me-2" onclick="toggleReadonly()">
                Habilitar Edição
            </button>
            <a href="{{ route('usersDataFlex_list.show', $userDataFlex->user_id) }}" class="btn btn-info btn-md px-4 me-2">Voltar Lista Perfil</a>
        </div>
        <div class="row mb-2">
            <div>
              Perfil (ID): <strong> {{ $userDataFlex->id }} </strong> - Habitat_ID: <strong> {{ $userDataFlex->habitat_id }} </strong> - Niche_ID: <strong> {{ $userDataFlex->niche_id }} </strong> - Niche_Level: <strong> {{ $userDataFlex->niche_level }} </strong>
            </div>        
            <div>
                Nome do Usuário: <strong>{{ $user->name }}</strong> - User_ID: <strong> {{ $userDataFlex->user_id }} </strong>
            </div>
            <div>
                Data de Cadastro:<strong>{{ \Carbon\Carbon::parse($userDataFlex->created_at)->format('d/m/Y H:i:s') }}</strong>
                - Data de Atualização:<strong>{{ \Carbon\Carbon::parse($userDataFlex->updated_at)->format('d/m/Y H:i:s') }}</strong>
            </div>
        </div>

        <form method="POST" action="{{ route('usersDataFlex_update.show', $userDataFlex->id) }}"  class="m-3">
            @csrf
            @method('PUT')
            @php
                $nicheLevel = $userDataFlex->niche_level;
                $data = $userDataFlex->user_profile;
                if (is_string($data)) {
                    try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
                }
                $iseNumber = isset($data['iseNumber']) ? $data['iseNumber'] : '0';

                $certificationEFSI = isset($data['certificationEFSI']) ? $data['certificationEFSI'] : 'Ensino Fundamental Séries Iniciais de Educação de Jovens e Adultos'; 
                $conclusionCertificationEFSI = isset($data['conclusionCertificationEFSI']) ? $data['conclusionCertificationEFSI'] : ''; 
                $ak1EFSIName = isset($data['ak1EFSIName']) ? $data['ak1EFSIName'] : 'LINGUAGENS E MATEMÁTICA';
                $ak1EFSIDescription = isset($data['ak1EFSIDescription']) ? $data['ak1EFSIDescription'] : 'Língua Portuguesa e Matemática';
                $ak1EFSIResult = isset($data['ak1EFSIResult']) ? $data['ak1EFSIResult'] : '';
                $ak1EFSIConclusion = isset($data['ak1EFSIConclusion']) ? $data['ak1EFSIConclusion'] : '';
                $ak1EFSIObs = isset($data['ak1EFSIObs']) ? $data['ak1EFSIObs'] : '';

                $certificationEFSF = isset($data['certificationEFSF']) ? $data['certificationEFSF'] : 'Ensino Fundamental Séries Finais de Educação de Jovens e Adultos';
                $conclusionCertificationEFSF = isset($data['conclusionCertificationEFSF']) ? $data['conclusionCertificationEFSF'] : '';
                $ak1EFSFName = isset($data['ak1EFSFName']) ? $data['ak1EFSFName'] : 'LINGUAGENS';
                $ak1EFSFDescription = isset($data['ak1EFSFDescription']) ? $data['ak1EFSFDescription'] : 'Língua Portuguesa, Literatura, Língua Inglesa, Arte e Educação Física';
                $ak1EFSFResult = isset($data['ak1EFSFResult']) ? $data['ak1EFSFResult'] : '';
                $ak1EFSFConclusion = isset($data['ak1EFSFConclusion']) ? $data['ak1EFSFConclusion'] : '';
                $ak1EFSFObs = isset($data['ak1EFSFObs']) ? $data['ak1EFSFObs'] : '';
                $ak2EFSFName = isset($data['ak2EFSFName']) ? $data['ak2EFSFName'] : 'MATEMÁTICA';
                $ak2EFSFDescription = isset($data['ak2EFSFDescription']) ? $data['ak2EFSFDescription'] : 'Matemática';
                $ak2EFSFResult = isset($data['ak2EFSFResult']) ? $data['ak2EFSFResult'] : '';
                $ak2EFSFConclusion = isset($data['ak2EFSFConclusion']) ? $data['ak2EFSFConclusion'] : '';
                $ak2EFSFObs = isset($data['ak2EFSFObs']) ? $data['ak2EFSFObs'] : '';
                $ak3EFSFName = isset($data['ak3EFSFName']) ? $data['ak3EFSFName'] : 'CIÊNCIAS DA NATUREZA';
                $ak3EFSFDescription = isset($data['ak3EFSFDescription']) ? $data['ak3EFSFDescription'] : 'Ciências';
                $ak3EFSFResult = isset($data['ak3EFSFResult']) ? $data['ak3EFSFResult'] : '';
                $ak3EFSFConclusion = isset($data['ak3EFSFConclusion']) ? $data['ak3EFSFConclusion'] : '';
                $ak3EFSFObs = isset($data['ak3EFSFObs']) ? $data['ak3EFSFObs'] : '';
                $ak4EFSFName = isset($data['ak4EFSFName']) ? $data['ak4EFSFName'] : 'CIÊNCIAS HUMANAS';
                $ak4EFSFDescription = isset($data['ak4EFSFDescription']) ? $data['ak4EFSFDescription'] : 'História, Geografia';
                $ak4EFSFResult = isset($data['ak4EFSFResult']) ? $data['ak4EFSFResult'] : '';
                $ak4EFSFConclusion = isset($data['ak4EFSFConclusion']) ? $data['ak4EFSFConclusion'] : '';
                $ak4EFSFObs = isset($data['ak4EFSFObs']) ? $data['ak4EFSFObs'] : '';

                $certificationEMAF = isset($data['certificationEMAF']) ? $data['certificationEMAF'] : 'Ensino Médio de Educação de Jovens e Adultos';
                $conclusionCertificationEMAF = isset($data['conclusionCertificationEMAF']) ? $data['conclusionCertificationEMAF'] : '';
                $ak1EMAFName = isset($data['ak1EMAFName']) ? $data['ak1EMAFName'] : 'LINGUAGENS E SUAS TECNOLOGIAS';
                $ak1EMAFDescription = isset($data['ak1EMAFDescription']) ? $data['ak1EMAFDescription'] : 'Língua Portuguesa, Literatura, Língua Espanhola, Língua Inglesa, Arte e Educação Física';
                $ak1EMAFResult = isset($data['ak1EMAFResult']) ? $data['ak1EMAFResult'] : '';
                $ak1EMAFConclusion = isset($data['ak1EMAFConclusion']) ? $data['ak1EMAFConclusion'] : '';
                $ak1EMAFObs = isset($data['ak1EMAFObs']) ? $data['ak1EMAFObs'] : '';
                $ak2EMAFName = isset($data['ak2EMAFName']) ? $data['ak2EMAFName'] : 'MATEMÁTICA E SUAS TECNOLOGIAS';
                $ak2EMAFDescription = isset($data['ak2EMAFDescription']) ? $data['ak2EMAFDescription'] : 'Matemática';
                $ak2EMAFResult = isset($data['ak2EMAFResult']) ? $data['ak2EMAFResult'] : '';
                $ak2EMAFConclusion = isset($data['ak2EMAFConclusion']) ? $data['ak2EMAFConclusion'] : '';
                $ak2EMAFObs = isset($data['ak2EMAFObs']) ? $data['ak2EMAFObs'] : 'Observação AK2 não cadastrada';
                $ak3EMAFName = isset($data['ak3EMAFName']) ? $data['ak3EMAFName'] : 'CIÊNCIAS DA NATUREZA E SUAS TECNOLOGIAS';
                $ak3EMAFDescription = isset($data['ak3EMAFDescription']) ? $data['ak3EMAFDescription'] : 'Física, Química e Biologia';
                $ak3EMAFResult = isset($data['ak3EMAFResult']) ? $data['ak3EMAFResult'] : 'Resultado AK3 não cadastrado';        
                $ak3EMAFConclusion = isset($data['ak3EMAFConclusion']) ? $data['ak3EMAFConclusion'] : 'Conclusão AK3 não cadastrada';
                $ak3EMAFObs = isset($data['ak3EMAFObs']) ? $data['ak3EMAFObs'] : 'Observação AK3 não cadastrada';
                $ak4EMAFName = isset($data['ak4EMAFName']) ? $data['ak4EMAFName'] : 'CIÊNCIAS HUMANAS E SUAS TECNOLOGIAS';
                $ak4EMAFDescription = isset($data['ak4EMAFDescription']) ? $data['ak4EMAFDescription'] : 'História, Geografia, Sociologia e Filosofia';
                $ak4EMAFResult = isset($data['ak4EMAFResult']) ? $data['ak4EMAFResult'] : 'Resultado AK4 não cadastrado';
                $ak4EMAFConclusion = isset($data['ak4EMAFConclusion']) ? $data['ak4EMAFConclusion'] : 'Conclusão AK4 não cadastrada';
                $ak4EMAFObs = isset($data['ak4EMAFObs']) ? $data['ak4EMAFObs'] : 'Observação AK4 não cadastrada';

                $nicheLevel = old('niche_level', $userDataFlex->niche_level ?? 0);

                $iseNumber = old('iseNumber', $data['iseNumber'] ?? '0');

                $certificationEFSI = old('certificationEFSI', $data['certificationEFSI'] ?? 'Ensino Fundamental Séries Iniciais de Educação de Jovens e Adultos');
                $conclusionCertificationEFSI = old('conclusionCertificationEFSI', $data['conclusionCertificationEFSI'] ?? '');
                $ak1EFSIName = old('ak1EFSIName', $data['ak1EFSIName'] ?? 'LINGUAGENS E MATEMÁTICA');
                $ak1EFSIDescription = old('ak1EFSIDescription', $data['ak1EFSIDescription'] ?? 'Língua Portuguesa e Matemática');
                $ak1EFSIResult = old('ak1EFSIResult', $data['ak1EFSIResult'] ?? '');
                $ak1EFSIConclusion = old('ak1EFSIConclusion', $data['ak1EFSIConclusion'] ?? '');
                $ak1EFSIObs = old('ak1EFSIObs', $data['ak1EFSIObs'] ?? '');
                
                $certificationEFSF = old('certificationEFSF', $data['certificationEFSF'] ?? 'Ensino Fundamental Séries Finais de Educação de Jovens e Adultos');
                $conclusionCertificationEFSF = old('conclusionCertificationEFSF', $data['conclusionCertificationEFSF'] ?? '');
                $ak1EFSFName = old('ak1EFSFName', $data['ak1EFSFName'] ?? 'LINGUAGENS');
                $ak1EFSFDescription = old('ak1EFSFDescription', $data['ak1EFSFDescription'] ?? 'Língua Portuguesa, Literatura, Língua Inglesa, Arte e Educação Física');
                $ak1EFSFResult = old('ak1EFSFResult', $data['ak1EFSFResult'] ?? '');
                $ak1EFSFConclusion = old('ak1EFSFConclusion', $data['ak1EFSFConclusion'] ?? '');
                $ak1EFSFObs = old('ak1EFSFObs', $data['ak1EFSFObs'] ?? '');
                $ak2EFSFName = old('ak2EFSFName', $data['ak2EFSFName'] ?? 'MATEMÁTICA');
                $ak2EFSFDescription = old('ak2EFSFDescription', $data['ak2EFSFDescription'] ?? 'Matemática');
                $ak2EFSFResult = old('ak2EFSFResult', $data['ak2EFSFResult'] ?? '');
                $ak2EFSFConclusion = old('ak2EFSFConclusion', $data['ak2EFSFConclusion'] ?? '');
                $ak2EFSFObs = old('ak2EFSFObs', $data['ak2EFSFObs'] ?? '');
                $ak3EFSFName = old('ak3EFSFName', $data['ak3EFSFName'] ?? 'CIÊNCIAS DA NATUREZA');
                $ak3EFSFDescription = old('ak3EFSFDescription', $data['ak3EFSFDescription'] ?? 'Ciências');
                $ak3EFSFResult = old('ak3EFSFResult', $data['ak3EFSFResult'] ?? '');
                $ak3EFSFConclusion = old('ak3EFSFConclusion', $data['ak3EFSFConclusion'] ?? '');
                $ak3EFSFObs = old('ak3EFSFObs', $data['ak3EFSFObs'] ?? '');
                $ak4EFSFName = old('ak4EFSFName', $data['ak4EFSFName'] ?? 'CIÊNCIAS HUMANAS');
                $ak4EFSFDescription = old('ak4EFSFDescription', $data['ak4EFSFDescription'] ?? 'Geografia, História');
                $ak4EFSFResult = old('ak4EFSFResult', $data['ak4EFSFResult'] ?? '');
                $ak4EFSFConclusion = old('ak4EFSFConclusion', $data['ak4EFSFConclusion'] ?? '');
                $ak4EFSFObs = old('ak4EFSFObs', $data['ak4EFSFObs'] ?? '');

                $certificationEMAF = old('certificationEMAF', $data['certificationEMAF'] ?? 'Ensino Médio de Educação de Jovens e Adultos');
                $conclusionCertificationEMAF = old('conclusionCertificationEMAF', $data['conclusionCertificationEMAF'] ?? '');
                $ak1EMAFName = old('ak1EMAFName', $data['ak1EMAFName'] ?? 'LINGUAGENS E SUAS TECNOLOGIAS');
                $ak1EMAFDescription = old('ak1EMAFDescription', $data['ak1EMAFDescription'] ?? 'Língua Portuguesa, Literatura, Língua Espanhola, Língua Inglesa, Arte e Educação Física');
                $ak1EMAFResult = old('ak1EMAFResult', $data['ak1EMAFResult'] ?? '');
                $ak1EMAFConclusion = old('ak1EMAFConclusion', $data['ak1EMAFConclusion'] ?? '');
                $ak1EMAFObs = old('ak1EMAFObs', $data['ak1EMAFObs'] ?? '');
                $ak2EMAFName = old('ak2EMAFName', $data['ak2EMAFName'] ?? 'MATEMÁTICA E SUAS TECNOLOGIAS');
                $ak2EMAFDescription = old('ak2EMAFDescription', $data['ak2EMAFDescription'] ?? 'Matemática');
                $ak2EMAFResult = old('ak2EMAFResult', $data['ak2EMAFResult'] ?? '');
                $ak2EMAFConclusion = old('ak2EMAFConclusion', $data['ak2EMAFConclusion'] ?? '');
                $ak2EMAFObs = old('ak2EMAFObs', $data['ak2EMAFObs'] ?? '');
                $ak3EMAFName = old('ak3EMAFName', $data['ak3EMAFName'] ?? 'CIÊNCIAS DA NATUREZA E SUAS TECNOLOGIAS');
                $ak3EMAFDescription = old('ak3EMAFDescription', $data['ak3EMAFDescription'] ?? 'Física, Química e Biologia');
                $ak3EMAFResult = old('ak3EMAFResult', $data['ak3EMAFResult'] ?? '');
                $ak3EMAFConclusion = old('ak3EMAFConclusion', $data['ak3EMAFConclusion'] ?? '');
                $ak3EMAFObs = old('ak3EMAFObs', $data['ak3EMAFObs'] ?? '');
                $ak4EMAFName = old('ak4EMAFName', $data['ak4EMAFName'] ?? 'CIÊNCIAS HUMANAS E SOCIAIS APLICADAS');
                $ak4EMAFDescription = old('ak4EMAFDescription', $data['ak4EMAFDescription'] ?? 'Geografia, História, Sociologia e Filosofia');
                $ak4EMAFResult = old('ak4EMAFResult', $data['ak4EMAFResult'] ?? '');
                $ak4EMAFConclusion = old('ak4EMAFConclusion', $data['ak4EMAFConclusion'] ?? '');
                $ak4EMAFObs = old('ak4EMAFObs', $data['ak4EMAFObs'] ?? '');
            @endphp
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-4 col-form-label" for="iseNumber"><strong>*Número do ISE:</strong></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="iseNumber" name="iseNumber" value="{{ old('iseNumber', $iseNumber) }}" readonly required autofocus>
                </div>
                <label  class="col-sm-2 col-form-label"></label>
                <label  class="col-sm-2 col-form-label" for="nicheLevel"><strong>Nível de Nicho:</strong></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="nicheLevel" name="nicheLevel" value="{{ old('nicheLevel', $nicheLevel) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label  class="col-sm-4 col-form-label" for="certificationEFSI"><strong>Certificação EFSI:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field bg-info text-white" id="certificationEFSI" name="certificationEFSI" value="{{ old('certificationEFSI', $certificationEFSI) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="conclusionCertificationEFSI" class="col-sm-4 col-form-label"><strong>Conclusão Certificação EFSI:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 2001 ou Cursando"class="form-control readonly-field" id="conclusionCertificationEFSI" name="conclusionCertificationEFSI" value="{{ old('conclusionCertificationEFSI', $conclusionCertificationEFSI) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSIName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EFSIName" name="ak1EFSIName" value="{{ old('ak1EFSIName', $ak1EFSIName) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSIDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EFSIDescription" name="ak1EFSIDescription" value="{{ old('ak1EFSIDescription', $ak1EFSIDescription) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSIResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak1EFSIResult" name="ak1EFSIResult" value="{{ old('ak1EFSIResult', $ak1EFSIResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSIConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak1EFSIConclusion" name="ak1EFSIConclusion" value="{{ old('ak1EFSIConclusion', $ak1EFSIConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSIObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak1EFSIObs" name="ak1EFSIObs" value="{{ old('ak1EFSIObs', $ak1EFSIObs) }}" autofocus>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-4 col-form-label" for="certificationEFSF"><strong>Certificação EFSF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field bg-primary text-white" id="certificationEFSF" name="certificationEFSF" value="{{ old('certificationEFSF', $certificationEFSF) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="conclusionCertificationEFSF" class="col-sm-4 col-form-label"><strong>Conclusão Certificação EFSF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 2001 ou Cursando"class="form-control readonly-field" id="conclusionCertificationEFSF" name="conclusionCertificationEFSF" value="{{ old('conclusionCertificationEFSF', $conclusionCertificationEFSF) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EFSFName" name="ak1EFSFName" value="{{ old('ak1EFSFName', $ak1EFSFName) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EFSFDescription" name="ak1EFSFDescription" value="{{ old('ak1EFSFDescription', $ak1EFSFDescription) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak1EFSFResult" name="ak1EFSFResult" value="{{ old('ak1EFSFResult', $ak1EFSFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak1EFSFConclusion" name="ak1EFSFConclusion" value="{{ old('ak1EFSFConclusion', $ak1EFSFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EFSFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak1EFSFObs" name="ak1EFSFObs" value="{{ old('ak1EFSFObs', $ak1EFSFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EFSFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak2EFSFName" name="ak2EFSFName" value="{{ old('ak2EFSFName', $ak2EFSFName) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EFSFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak2EFSFDescription" name="ak2EFSFDescription" value="{{ old('ak2EFSFDescription', $ak2EFSFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EFSFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 2 :</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak2EFSFResult" name="ak2EFSFResult" value="{{ old('ak2EFSFResult', $ak2EFSFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EFSFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak2EFSFConclusion" name="ak2EFSFConclusion" value="{{ old('ak2EFSFConclusion', $ak2EFSFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EFSFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak2EFSFObs" name="ak2EFSFObs" value="{{ old('ak2EFSFObs', $ak2EFSFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EFSFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak3EFSFName" name="ak3EFSFName" value="{{ old('ak3EFSFName', $ak3EFSFName) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EFSFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak3EFSFDescription" name="ak3EFSFDescription" value="{{ old('ak3EFSFDescription', $ak3EFSFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EFSFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak3EFSFResult" name="ak3EFSFResult" value="{{ old('ak3EFSFResult', $ak3EFSFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EFSFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak3EFSFConclusion" name="ak3EFSFConclusion" value="{{ old('ak3EFSFConclusion', $ak3EFSFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EFSFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak3EFSFObs" name="ak3EFSFObs" value="{{ old('ak3EFSFObs', $ak3EFSFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EFSFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak4EFSFName" name="ak4EFSFName" value="{{ old('ak4EFSFName', $ak4EFSFName) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EFSFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak4EFSFDescription" name="ak4EFSFDescription" value="{{ old('ak4EFSFDescription', $ak4EFSFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EFSFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak4EFSFResult" name="ak4EFSFResult" value="{{ old('ak4EFSFResult', $ak4EFSFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EFSFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak4EFSFConclusion" name="ak4EFSFConclusion" value="{{ old('ak4EFSFConclusion', $ak4EFSFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EFSFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak4EFSFObs" name="ak4EFSFObs" value="{{ old('ak4EFSFObs', $ak4EFSFObs) }}" autofocus>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-2">
                <label  class="col-sm-4 col-form-label" for="certificationEMAF"><strong>Certificação EMAF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field bg-success text-white" id="certificationEMAF" name="certificationEMAF" value="{{ old('certificationEMAF', $certificationEMAF) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="conclusionCertificationEMAF" class="col-sm-4 col-form-label"><strong>Conclusão Certificação EMAF:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 2001 ou Cursando"class="form-control readonly-field" id="conclusionCertificationEMAF" name="conclusionCertificationEMAF" value="{{ old('conclusionCertificationEMAF', $conclusionCertificationEMAF) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EMAFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EMAFName" name="ak1EMAFName" value="{{ old('ak1EMAFName', $ak1EMAFName) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EMAFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak1EMAFDescription" name="ak1EMAFDescription" value="{{ old('ak1EMAFDescription', $ak1EMAFDescription) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EMAFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak1EMAFResult" name="ak1EMAFResult" value="{{ old('ak1EMAFResult', $ak1EMAFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EMAFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak1EMAFConclusion" name="ak1EMAFConclusion" value="{{ old('ak1EMAFConclusion', $ak1EMAFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak1EMAFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 1:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak1EMAFObs" name="ak1EMAFObs" value="{{ old('ak1EMAFObs', $ak1EMAFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EMAFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak2EMAFName" name="ak2EMAFName" value="{{ old('ak2EMAFName', $ak2EMAFName) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EMAFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak2EMAFDescription" name="ak2EMAFDescription" value="{{ old('ak2EMAFDescription', $ak2EMAFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EMAFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 2 :</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak2EMAFResult" name="ak2EMAFResult" value="{{ old('ak2EMAFResult', $ak2EMAFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EMAFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak2EMAFConclusion" name="ak2EMAFConclusion" value="{{ old('ak2EMAFConclusion', $ak2EMAFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak2EMAFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 2:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak2EMAFObs" name="ak2EMAFObs" value="{{ old('ak2EMAFObs', $ak2EMAFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EMAFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak3EMAFName" name="ak3EMAFName" value="{{ old('ak3EMAFName', $ak3EMAFName) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EMAFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak3EMAFDescription" name="ak3EMAFDescription" value="{{ old('ak3EMAFDescription', $ak3EMAFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EMAFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak3EMAFResult" name="ak3EMAFResult" value="{{ old('ak3EMAFResult', $ak3EMAFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EMAFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak3EMAFConclusion" name="ak3EMAFConclusion" value="{{ old('ak3EMAFConclusion', $ak3EMAFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak3EMAFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 3:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak3EMAFObs" name="ak3EMAFObs" value="{{ old('ak3EMAFObs', $ak3EMAFObs) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EMAFName" class="col-sm-4 col-form-label"><strong>Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak4EMAFName" name="ak4EMAFName" value="{{ old('ak4EMAFName', $ak4EMAFName) }}" readonly required autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EMAFDescription" class="col-sm-4 col-form-label"><strong>Descrição Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control readonly-field" id="ak4EMAFDescription" name="ak4EMAFDescription" value="{{ old('ak4EMAFDescription', $ak4EMAFDescription) }}" readonly autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EMAFResult" class="col-sm-4 col-form-label"><strong>Resultado Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 5,5 ou A" class="form-control" id="ak4EMAFResult" name="ak4EMAFResult" value="{{ old('ak4EMAFResult', $ak4EMAFResult) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EMAFConclusion" class="col-sm-4 col-form-label"><strong>Conclusão Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: 01/01/2001" class="form-control" id="ak4EMAFConclusion" name="ak4EMAFConclusion" value="{{ old('ak4EMAFConclusion', $ak4EMAFConclusion) }}" autofocus>
                </div>
            </div>
            <div class="row mb-2">
                <label for="ak4EMAFObs" class="col-sm-4 col-form-label"><strong>Observações Área de Conhecimento 4:</strong></label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Ex.: Aproveitamento de estudos do Exame Nacional do Ensino Médio, ENEM 2015, Secretaria da Educação, Porto Alegre/RS." class="form-control" id="ak4EMAFObs" name="ak4EMAFObs" value="{{ old('ak4EMAFObs', $ak4EMAFObs) }}" autofocus>
                </div>
            </div>
            <div class="py-2 mb-4 rounded">
                <hr style="margin:8px 0; opacity:.3;">
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>

    <script>
    function toggleReadonly() {
        const readonlyFields = document.querySelectorAll('.readonly-field');
        readonlyFields.forEach(field => {
            if (field.hasAttribute('readonly')) {
                field.removeAttribute('readonly');
                field.classList.add('border-success');
            } else {
                field.setAttribute('readonly', true);
                field.classList.remove('border-success');
            }
        });
    }
    </script>



@endsection
