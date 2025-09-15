<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        body {
            background: #f6f8fa;
        }
        .auth-container {
            max-width: 500px;
            margin: 5rem auto;
            padding: 2.5rem 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        .auth-logo {
            display: block;
            margin: 0 auto 1.5rem;
            width: 100px;
            height: 100px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.95em;
            color: #888;
        }
        .form-group {
            margin-bottom: 1.2em;
        }
        a {
            color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @php
            $logo = asset('images/logo_ecoidoa.png');
        @endphp

        @if(isset($logo))
            <img src="{{ $logo }}" alt="Logo" class="auth-logo">
        @endif
        <div class="auth-header">
            <h2>{{ $title ?? 'Bem-vindo' }}</h2>
            @if(isset($subtitle))
                <p>{{ $subtitle }}</p>
            @endif
        </div>

        @if (session('status'))
            <div style="color:green; margin-bottom:1em;">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div style="color:red; margin-bottom:1em;">
                <ul style="margin:0; padding:0 1em;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

        <div class="auth-footer">
            &copy; {{ date('Y') }} IdoA. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>