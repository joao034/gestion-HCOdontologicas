<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">C. ENFERMEDAD ACTUAL <span class="text-danger">*</span></h5>
        <hr>
        <textarea class="form-control" placeholder="Registrar sintomas, cronología, localización, características, intensidad, causa aparente y síntomas asociados" id="enfermedad_actual" name="enfermedad_actual" required
            {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $hClinica->consulta?->enfermedad_actual : old('enfermedad_actual') }}</textarea>
    </div>
</div>


