@extends('layouts.app')
@section('content')
    <div class="container">
        <main class="flex w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
            <div class="">
                <div class="">
                    <p class="mx-auto p-2">Bem-vindo ao ecossistema do</p>
                    <h1>Instituto de Filosofia do Antropoceno (IdoA)</h1>                 
                </div>
                <div class="center-box text-[14px]">
                    <h5>Vamos Começar!</h5>
                    <p>O IdoA é um ecossistema incrivelmente rico.<br>Sugerimos que você inicie no NEAD (Núcleo de Educação a Distância).</p>
                    <hr style="margin:16px 0; opacity:.3;">
                    <h4 style="font-weight:600; margin-bottom:8px;">Escolha seu Habitat/Nicho:</h4>
                </div>
                <div style="display:grid; gap:10px;">
                    @foreach($habitats as $h)   
                        @php
                            $data = $h->habitat_data;
                            if (is_string($data)) { 
                                try { $data = json_decode($data, true); } 
                                catch (\Throwable $e) { $data = []; }
                            }
                            $habitatUrl = $data['habitat_url'] ?? ($data['habitaturl'] ?? null);
                        @endphp
                        <div style="padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; background:#f8fafc;">
                            @if(!empty($habitatUrl))
                                <a href="{{ $habitatUrl }}" target="_blank" class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1">
                                    <div style="font-size:14px; font-weight:600; color:#0f172a;">{{ $h->habitat }}</div>
                                </a>
                            @else
                                <div style="font-size:14px; font-weight:600; color:#0f172a;">{{ $h->habitat }}</div> 
                            @endif
                            @if(!empty($data['description']))
                                <div style="font-size:12px; color:#475569; margin-top:4px;">{{ $data['description'] }}</div>
                            @endif
                            <div style="font-size:11px; color:#94a3b8; margin-top:6px;">ID: {{ $h->id }}</div>
                        </div>
                    @endforeach
                    @if($habitats->isEmpty())
                        <p style="font-size:12px; color:#64748b;">Nenhum habitat cadastrado.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
