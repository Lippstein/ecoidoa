@extends('layouts.dashboard')
@section('content')
    <div class='dashboard-header'>
        {{ session('user_name') }}
            - Seu ID de Usuário:
            {{ auth()->id() }}
    </div>
    <div>
        <p>Seu Ecossistema: </p>

        @if($usersDataFlexList->isEmpty())
            <p>Nenhum HABITAT encontrado.
                <a href="{{ route('habitats_niches.show') }}">ESCOLHER UM HABITAT</a>
            </p>
        @else
            <ul>
                @foreach($usersDataFlexList as $item)
                    @php
                    // dd($usersDataFlexList);
                        $habitat = $item->habitat->habitat;
                        $niche = $item->niche->niche;
                        $data = $item->niche->niche_data;
                        $vj = json_decode($data, JSON_UNESCAPED_UNICODE);
                        $values = array_values($vj);
                        $second = $values[1];
                        // if (is_array($data)) {
                        //     try { $data = json_decode($data, true); } 
                        //     catch (\Throwable $e) { $data = []; }
                        // }                        
                    @endphp
                    
                    <li>
                        ID: {{ $item->id }}<br>
                        Habitat: {{ $item->habitat->habitat }}<br>
                        Niche: {{ $item->niche->niche }}<br>
                        {{ is_array($second) ? json_encode($second) : $second }}<br>

                        Dados: {{ $data }}<br>
                        @if ($habitat === 'NEAD')
                            <a href="{{ route('nead.show', $item->niche_id) }}">
                                {{ $habitat }}
                            </a>
                        @elseif ($habitat === 'RATEIO')
                            <a href="{{ route('rateio.show', $item->niche_id) }}">
                                {{ $habitat }}
                            </a>
                        @elseif ($habitat === 'OUTROSISTEMA')
                            {{-- <a href="{{ route('outrosistema.show', $item->niche_id) }}">
                                {{ $habitat }}
                            </a> --}}
                        @endif

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
{{-- 
                ID: {{ $item->id }}<br>
                User ID: {{ $item->user_id }}<br>
                Nome: {{ $item->user->name }}<br>
                Habitat ID: {{ $item->habitat_id }}<br>
                Habitat: {{ $item->habitat->habitat }}<br>
                Niche ID: {{ $item->niche_id }}<br>
                Niche: {{ $item->niche->niche }}<br>
                Dados: {{ $data }}
                Dados: {{ is_array($item->user_data_flex) ? json_encode($item->user_data_flex, JSON_UNESCAPED_UNICODE) : $item->user_data_flex }}
 --}}




                        {{-- @foreach($habitats as $h)
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
                                    <ul style="margin:6px 0 0 0; padding:0; list-style:none;">
                                        @forelse($h->niches as $niche)
                                            @php
                                                $ndata = $niche->niche_data;
                                                if (is_string($ndata)) {
                                                    try { $ndata = json_decode($ndata, true); } catch (\Throwable $e) { $ndata = []; }
                                                }
                                            @endphp
                                            <li style="margin-bottom:6px; padding:6px 10px; background:#e0e7ef; border-radius:8px;">
                                                <span style="font-weight:600; color:#1e293b;"><strong>{{ $niche->niche }}</strong></span>
                                                @if(!empty($ndata['description']))
                                                    <span style="font-size:12px; color:#475569; margin-left:8px;">{{ $ndata['description'] }}</span>
                                                @endif
                                                <span style="font-size:11px; color:#64748b; margin-left:8px;">ID: {{ $niche->id }}</span>
                                            </li>
                                        @empty
                                            <li style="font-size:12px; color:#64748b;">Nenhum niche cadastrado para este habitat.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        @if($habitats->isEmpty())
                            <p style="font-size:12px; color:#64748b;">Nenhum habitat cadastrado.</p>
                        @endif

 --}}
