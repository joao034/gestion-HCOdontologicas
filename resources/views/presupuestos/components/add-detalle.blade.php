<form action="{{ route('presupuestos.store') }}" method="POST">
    @csrf
    <input type="hidden" name="presupuesto_id" value="{{ $presupuesto->id }}">
    <div class="row mt-3">
        <div class="input-group mb-3">
            <div class="col-sm-8 col-md-7 col-lg-5 col-8">
                <select class="form-select form-select-md" name="tratamiento_id" required>
                    <option selected> ¿Desea agregar otro tratamiento?</option>
                    @foreach ($tratamientos as $tratamiento)
                        <option value="{{ $tratamiento->id }}">
                            {{ $tratamiento->nombre . ' - $ ' . $tratamiento->precio }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-4">
                <button class="btn btn-primary" type="submit"><i class="fa-regular fa-plus"></i> Agregar</button>
            </div>
        </div>
    </div>
</form>