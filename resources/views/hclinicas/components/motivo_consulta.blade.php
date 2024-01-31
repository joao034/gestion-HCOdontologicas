<div class="form-floating mt-2">
    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="motivo_consulta"
        {{ $modo == 'show' ? 'readonly' : '' }} required> {{ $modo == 'show' || $modo == 'edit' ? $paciente->consulta?->motivo_consulta : old('motivo_consulta') }}</textarea>
    <label for="floatingTextarea2" class="fw-bold">B. MOTIVO DE LA CONSULTA <span class="text-danger">*</span> <span
            style="color: gray; font-weight: normal">(Anotar la causa del problema en la versión del
            informante)</span></label>
</div>
