<div class="form-floating mt-2">
    <textarea class="form-control" placeholder="Leave a comment here" id="motivo_consulta" name="motivo_consulta" required
        {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->consulta?->motivo_consulta : old('motivo_consulta') }}</textarea>
    <label for="motivo_consulta" class="fw-bold">B. MOTIVO DE LA CONSULTA <span class="text-danger">*</span> <span
            style="color: gray; font-weight: normal">(Anotar la causa del problema en la versión del
            informante)</span></label>
</div>
