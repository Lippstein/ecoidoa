@extends('layouts.app')
@section('content')
    {{-- <div class='dashboard-header'>
        <p>Usuário: {{ session('user_name') }}</p>
        <p>Seu ID de Usuário: {{ auth()->id() }}</p> 
    </div> --}}
    <div class="container">
        <div class="py-2 mb-4 rounded">
            <h4 class="text-center">Lista de Nichos </h4>
        </div>
        @if($niches->isEmpty())
            <script>
                window.location.href = "{{ route('niches_create.show') }}";
            </script>
        @else
        <h4>Não está vazio </h4>
                    <script>
                window.location.href = "{{ route('niches_create.show') }}";
            </script>
        @endif
    </div>
@endsection
