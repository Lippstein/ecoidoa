<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IdoA')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        @php
            $logo = asset('images/logo_ecoidoa.png');
        @endphp
        @if(isset($logo))
            <img src="{{ $logo }}" class="rounded mx-auto d-block" alt="Logo IdoA" style="width:100px; height:100px; margin-bottom:16px;">
        @endif
        <div>
            <h3 class="text-center">{{ $title ?? 'Bem-vindo' }}</h3>
            @if(isset($subtitle))
                <p>{{ $subtitle }}</p>
            @endif
        </div>

        @if (session('status'))
            <div class="text-center alert alert-warning" role="alert">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div style="color:red; margin-bottom:1em;">
                <ul style="margin:0; padding:0 1em;">
                    @foreach ($errors->all() as $error)
                        <div class="text-center alert alert-warning" role="alert">{{ $error }}</div>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
        <div class="mt-4 mb-4">
            <p class="text-center" style="font-size: small;"><em>IdoA - Instituto de Filosofia do Antropoceno</em> &copy; {{ date('Y') }} Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>