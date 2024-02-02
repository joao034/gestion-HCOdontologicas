<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">B. MOTIVO DE LA CONSULTA <span class="text-danger">*</span></h5>
        <hr>
        <textarea class="form-control" placeholder="Anotar la causa del problema en la versión del informante" id="motivo_consulta" name="motivo_consulta" required
        {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->consulta?->motivo_consulta : old('motivo_consulta') }}</textarea>
    </div>
</div>
