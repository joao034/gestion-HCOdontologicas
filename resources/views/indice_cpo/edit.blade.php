<div class="card my-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">J. ÍNDICES CPO-ceo</h5>
        <hr>
        <form action="{{ route('update.cpo', $odontograma->id) }}" method="post">
            @csrf
            @method('PUT')
            @include('hclinicas.components.indices_cpo_ceo', ['modo' => 'edit'])

            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-check"></i>
                    Guardar</button>
            </div>
        </form>
    </div>
</div>
