<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

        <header>
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="text-[12px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
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
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
