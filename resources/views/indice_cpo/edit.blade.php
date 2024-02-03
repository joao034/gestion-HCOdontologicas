<form action="{{ route('update.cpo', $odontograma->id) }}" method="post">
    @csrf
    @method('PUT')
    @include('hclinicas.components.indices_cpo_ceo', ['modo' => 'edit'])

    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
            Guardar</button>
    </div>
</form>
