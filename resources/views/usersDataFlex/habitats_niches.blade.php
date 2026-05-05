<?php
use App\Models\UsersDataFlex;
?>
@extends('layouts.app')
@section('content')
    {{-- <div class='dashboard-header'>
        <p>Usuário: {{ session('user_name') }}</p>
        <p>Seu ID de Usuário: {{ auth()->user()->id }}</p>
        <p>Nível de Acesso: {{ Auth::user()->level }}</p>
        <p>Nome de Usuário: {{ Auth::user()->name }}</p>
    </div> --}}
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Seu Ecossistema </h4>
            <p class="text-center">{{ Auth::user()->name }} - Escolha seu Habitat e Nicho</p>
            <p class="text-center">Os botões ativos abaixo permitem escolher um novo Habitat e Nicho</p>
        </div>
        <div class="flex items-center justify-center w-rounded">
            <main class="flex w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="text-[12px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded">
                    <form method="POST" action="{{ route('habitats_niches.save') }}">
                        @csrf
                        {{-- <input type="hidden" name="invite" value="{{ auth()->id() }}"> --}}
                        <div style="display:grid; gap:18px;">
                            @foreach($habitats as $h)
                                @php
                                    $data = $h->habitat_data;
                                    if (is_string($data)) {
                                        try { $data = json_decode($data, true); } catch (\Throwable $e) { $data = []; }
                                    }
                                @endphp
                                <div style="padding:14px 18px; border:1px solid #e2e8f0; border-radius:12px; background:#f8fafc;">
                                    <span style="font-size:13px; text-decoration:underline; color:#334155;">Habitat:</span>
                                    <div style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:4px;">
                                        {{ $h->habitat }}
                                    </div>
                                    @if(!empty($data['description']))
                                        <div style="font-size:13px; color:#475569; margin-bottom:6px;">
                                            {{ $data['description'] }} 
                                            <span style="font-size:12px; color:#94a3b8; margin-bottom:8px; margin-left:8px;">
                                                ID: {{ $h->id }}
                                            </span>
                                        </div>
                                    @endif

                                    <div style="margin-top:8px;">
                                        <span style="font-size:13px; text-decoration:underline; color:#334155;">Nichos:</span>
                                        <div style="margin:6px 0 0 0; padding:0; list-style:none;">
                                            @forelse($h->niches as $niche)
                                                @php
                                                    $ndata = $niche->niche_data;
                                                    if (is_string($ndata)) {
                                                        try { $ndata = json_decode($ndata, true); } catch (\Throwable $e) { $ndata = []; }
                                                    }
                                                    $aux = '';
                                                    $exists = UsersDataFlex::where('user_id', auth()->id())
                                                        ->where('niche_id', $niche->id)
                                                        ->where('habitat_id', $h->id)
                                                        ->exists();
                                                        // DD($exists);
                                                    if ($exists){
                                                        $aux='disabled'; 
                                                    }
                                                @endphp    
                                                <div id="niches" style="margin-bottom:6px; padding:6px 10px; background:#e0e7ef; border-radius:8px; display:flex; align-items:center;">
                                                    <input type="radio" name="u_n_h_id" value="{{ json_encode(['n_id' => $niche->id, 'h_id' => $h->id]) }}" style="margin-right:10px;" {{ $aux }} required>
                                                    <span style="font-weight:600; color:#1e293b;"><strong>{{ $niche->niche }}</strong></span>
                                                    @if(!empty($ndata['description']))
                                                        <span style="font-size:12px; color:#475569; margin-left:8px;">{{ $ndata['description'] }} - {{ $ndata['company_name'] }}</span>
                                                    @endif
                                                    <span style="font-size:11px; color:#64748b; margin-left:8px;">ID: {{ $niche->id }}</span>
                                                </div>
                                                @if(in_array($niche->id, [3,4]))
                                                    <div style="font-size: 10px; margin-left:24px; padding:6px 10px; background:#cbd5e1; border-radius:8px;">
                                                        <input type="text" class="form-control form-control-sm" name="invite_{{ $niche->id }}" id="invite_{{ $niche->id }}" style="margin-right:10px;" maxlength="20" placeholder="Convite do Nicho!">
                                                    </div>
                                                @endif
                                            @empty
                                                <li style="font-size:12px; color:#64748b;">Nenhum niche cadastrado para este habitat.</li>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach                       
                            @if($habitats->isEmpty())
                                <p style="font-size:12px; color:#64748b;">Nenhum habitat cadastrado.</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="submit" class="btn btn-cancel">Cancelar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection