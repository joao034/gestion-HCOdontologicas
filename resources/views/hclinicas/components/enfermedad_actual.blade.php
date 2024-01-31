<div class="form-floating mt-2">
    <textarea class="form-control" placeholder="Leave a comment here" id="enfermedad_actual" name="enfermedad_actual" required
        {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->consulta?->enfermedad_actual : old('enfermedad_actual') }}</textarea>
    <label for="enfermedad_actual" class="fw-bold">C. ENFERMEDAD ACTUAL <span class="text-danger">*</span> <span
            style="color: gray; font-weight: normal">(Registrar sintomas, cronología, localización, características,
            intensidad, causa aparente y síntomas asociados)</span></label>
</div>
