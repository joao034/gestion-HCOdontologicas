<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-bold">O. PROFESIONAL RESPONSABLE</h5>
        <hr>
        <form action="{{route('update.profesional_responsable', $hClinica->id)}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="hclinica_id" value="{{$hClinica->id}}">
            @include('hclinicas.components.profesional_responsable', ['modo' => 'edit'])
            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-check"></i>
                    Guardar</button>
            </div>
        </form>
    </div>
</div>
