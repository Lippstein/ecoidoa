@extends("layouts.app")
@section('title', 'Idoa')
@section('content')
<div class="container">
    <div class="py-2 mb-4 rounded">
        <h4 class="text-center">Reordene os termos Específicos</h4>
    </div>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('tesauro_list.show', ['niche_filter' => request('niche_filter'), 'bt_filter' => request('bt_filter')]) }}" class="btn btn-info">Voltar para o Tesauro</a>
    </div>
    <ul id="term-list" class="list-group mb-3">
        @foreach($filhos as $rel)
            {{-- <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $rel->id_term_nt }}"> --}}

            <li 
                class="list-group-item d-flex justify-content-between align-items-center" 
                data-id="{{ $rel->id_term_nt }}" 
                data-term-order="{{ $rel->term_order }}"
            >
                <span>{{ $rel->termNt->term }}</span>
                <span>
                    <button type="button" class="btn btn-sm btn-outline-secondary move-up" title="Subir">&#9650;</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary move-down" title="Descer">&#9660;</button>
                </span>
            </li>
        @endforeach
    </ul>
    {{-- <button onclick="saveOrder()" class="btn btn-primary">Salvar ordem</button> --}}
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const list = document.getElementById('term-list');
    if (!list) return;

    // Handler para subir/descer os termos
    list.addEventListener('click', function(e) {
        // SUBIR
        if (e.target.classList.contains('move-up')) {
            const li = e.target.closest('li');
            const prev = li.previousElementSibling;

            if (!prev) { // Já é o primeiro, não faz nada
                e.target.disabled = true;
                setTimeout(() => e.target.disabled = false, 500);
                return;
            }
            swapTermOrder(li, prev, 'up');
        }

        // DESCER
        if (e.target.classList.contains('move-down')) {
            const li = e.target.closest('li');
            const next = li.nextElementSibling;

            if (!next) { // Já é o último, não faz nada
                e.target.disabled = true;
                setTimeout(() => e.target.disabled = false, 500);
                return;
            }
            swapTermOrder(li, next, 'down');
        }
    });

    /**
     * Troca os valores de term_order e a posição visual dos dois elementos.
     * direction: 'up' ou 'down'
     */
     
    function swapTermOrder(liA, liB, direction) {
        const idA = liA.getAttribute('data-id');
        const idB = liB.getAttribute('data-id');
        const orderA = liA.getAttribute('data-term-order');
        const orderB = liB.getAttribute('data-term-order');
        
        fetch('{{ route('tesauro.swapOrder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                idA: idA,
                idB: idB,
                orderA: orderA,
                orderB: orderB,
                id_term_bt: '{{ $id_term_bt }}',
                id_niche: '{{ $id_niche }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                // Troca os atributos term_order no DOM
                liA.setAttribute('data-term-order', orderB);
                liB.setAttribute('data-term-order', orderA);

                // Troca visual na lista
                if(direction === 'up') {
                    list.insertBefore(liA, liB);
                } else if(direction === 'down') {
                    list.insertBefore(liB, liA);
                }

                // Feedback visual opcional (pode recarregar ou mostrar msg)
                // location.reload() para garantir recarregamento ao usuário
                setTimeout(function() {
                    location.reload();
                }, 300);
            } else {
                alert('Erro ao atualizar ordem!');
            }
        });
    }

    // /**
    //  * Envia a ordem visual atual de todos os itens
    //  */
    // window.saveOrder = function() {
    //     let ids = [];    
    //     document.querySelectorAll('#term-list li').forEach(function(li){
    //         ids.push(li.getAttribute('data-id'));
    //     });
    //     fetch('{{ route('tesauro.swapOrder') }}', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         },
    //         body: JSON.stringify({
    //             ids: ids,
    //             id_term_bt: '{{ $id_term_bt }}',
    //             id_niche: '{{ $id_niche }}'
    //         })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if(data.success){
    //             alert('Ordem salva com sucesso!');
    //             location.reload();
    //         } else {
    //             alert('Erro ao salvar ordem!');
    //         }
    //     });
    // }
});
</script>
@endsection
