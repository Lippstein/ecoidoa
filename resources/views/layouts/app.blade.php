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
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark rounded" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('welcome') }}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-asterisk" viewBox="0 0 16 16">
  <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
</svg>                    
                    IdoA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('habitats_niches.show') }}">Ecossistema</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Início3</a>
                        </li>
                         @if(auth()->check() and Auth::user()->level >= 5)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manutenção
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('users_list.show') }}">Usuários</a></li>
                                    <li><a class="dropdown-item" href="{{ route('habitats_list.show') }}">Habitats</a></li>
                                    <li><a class="dropdown-item" href="{{ route('niches_list.show') }}">Niches</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tesauro_list.show') }}">Tesauro</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center padding-1">
                        @if(auth()->check())
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
</svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>                                     Nova Conta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg>
                                    Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        {{-- @php
            $logo = asset('images/logo_ecoidoa.png');
        @endphp
        @if(isset($logo))
            <img src="{{ $logo }}" alt="Logo" class="dashboard-logo">
        @endif --}}
        {{-- <div>
            <h3 class="text-center">{{ $title ?? 'Bem-vindo' }}</h3>
            @if(isset($subtitle))
                <p>{{ $subtitle }}</p>
            @endif
        </div> --}}
                @if(auth()->check() && (int) auth()->user()->level === 0)
                    <div class="alert alert-info mt-3 mb-3" role="alert">
                        <h5 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16" style="margin-right: 8px;">
                                <path d="M6.956 1.745C7.021.81 7.908.087 8.9.087c.9 0 1.823.75 1.915 1.659.02.272.092.59.213.933.876 4.502 3.082 7.602 5.857 9.06M8 16a.5.5 0 0 1-.5-.5v-5.623m0-10.058v.651.859c0 1.042-.053 2.062-.184 3.056g1.852 4.694c2.287-1.346 4.106-3.755 4.332-6.354.205-2.838-.822-4.694-2.36-5.193-.955-.868-2.333-.265-2.334 1.39Z"/>
                            </svg>
                            Bem-vindo, {{ auth()->user()->name }}!
                        </h5>
                    </div>
                @endif
        @if (session('status'))
            <div class="text-center alert alert-warning" role="alert">{{ session('status') }}</div>
        @endif
        @if (session('success'))
            <div class="text-center alert alert-success" role="alert">{{ session('success') }}</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>