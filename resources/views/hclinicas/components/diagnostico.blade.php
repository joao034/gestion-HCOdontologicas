<div class="row justify-content-center mt-4">
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title fw-bolder">Diagnóstico</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="diagnostico" id="diagnostico"
                            aria-describedby="helpId" placeholder="Escriba el diagnóstico"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $diagnostico?->diagnostico : old('diagnostico') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="diagnostico" class="fw-bold">Diagnóstico</label>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="enfermedad_actual" id="enfermedad_actual"
                            aria-describedby="helpId" placeholder="Escriba la enfermedad actual"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $diagnostico?->enfermedad_actual : old('enfermedad_actual') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="enfermedad_actual" class="fw-bold">Enfermedad Actual</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
