<div class="form-floating mt-2">
    <textarea class="form-control" placeholder="Leave a comment here" id="enfermedad_actual" name="enfermedad_actual" required
        {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->consulta?->enfermedad_actual : old('enfermedad_actual') }}</textarea>
    <label for="enfermedad_actual" class="fw-bold fs-5">C. ENFERMEDAD ACTUAL <span class="text-danger">*</span> <span class="info_extra fs-6">(Registrar sintomas, cronología, localización, características,
            intensidad, causa aparente y síntomas asociados)</span></label>
</div>
