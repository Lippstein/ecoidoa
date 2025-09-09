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
                    <div class="center-box text-2xl">
                        <p >Bem-vindo ao</p>
                        <h1 style="font-style:italic; font-weight:900; margin-bottom:8px;">Instituto de Filosofia do Antropoceno (IdoA)</h1>                 
                    </div>
                    <div class="center-box text-[14px]">
                        <h5>Vamos Começar!</h5>
                        <p>O IdoA é um ecossistema incrivelmente rico.<br>Sugerimos que você inicie no NEAD (Núcleo de Educação a Distância).</p>
                        <hr style="margin:16px 0; opacity:.3;">
                        <h2 style="font-weight:600; margin-bottom:8px;">Escolha seu Habitat:</h2>
                    </div>
                    <div style="display:grid; gap:10px;">
                        @foreach($habitats as $h)                                
                            @php
                                $data = $h->habitat_data;
                                if (is_string($data)) { 
                                    try { $data = json_decode($data, true); } 
                                    catch (\Throwable $e) { $data = []; }
                                }
                            @endphp
                            <div style="padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; background:#f8fafc;">
                                @if(!empty($data['habitaturl']))
                                    <a href="{{ $data['habitaturl'] }}" target="_blank" class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1">
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
    </body>
</html>
