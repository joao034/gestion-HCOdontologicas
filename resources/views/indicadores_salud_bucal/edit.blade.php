<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">I. INDICADORES DE SALUD BUCAL</h5>
        <form action="{{route('update.indicador_salud_bucal', $odontograma->id)}}" method="post">
            @csrf
            @method('PUT')
            @include('hclinicas.components.indicadores_salud_bucal', ['modo' => 'edit'])
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-check"></i>
                    Guardar</button>
            </div>
        </form>
    </div>
</div>
