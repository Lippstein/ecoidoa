@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () =>{
            Swal.fire({
                title: "Pronto!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () =>{
            Swal.fire({
                title: "Erro!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        });
    </script>
@endif

@if ($errors->any())
    @php
        $errorMessage = '';
        foreach ($errors->all() as $error) {
            $errorMessage .= $error . '<br> ';
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () =>{
            Swal.fire({
                title: "Erro!",
                html: "{!! $errorMessage !!}",
                icon: "error"
            });
        });
    </script>
    <div class="alert-error">
       @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif
