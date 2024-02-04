@php
    $tipo_diagnostico = [
        'preventivo' => 'PRE',
        'definitivo' => 'DEF',
    ];
@endphp

<div class="form-floating mb-2">
    <input type="text" class="form-control" name="diagnostico" id="diagnostico" aria-describedby="helpId"
        placeholder="Escriba el diagnóstico" required
        value="{{ isset($diagnostico) ? $diagnostico->diagnostico : '' }}"
        {{ $modo == 'show' ? 'readonly' : '' }}>
    <label for="diagnostico" class="fw-bold">Diagnóstico <span class="text-danger">*</span></label>
</div>


<div class="form-floating mb-2">
    <input type="text" class="form-control" name="CIE" id="diagnostico" required aria-describedby="helpId" value="{{ isset($diagnostico) ? $diagnostico->CIE : '' }}"
        placeholder="CIE" {{ $modo == 'show' ? 'readonly' : '' }}>
    <label for="diagnostico" class="fw-bold">CIE <span class="text-danger">*</span></label>

</div>

<div class="form-floating mb-2">
    <select class="form-select" name="tipo" required id="tipo" {{ $modo == 'show' ? 'disabled' : '' }}>
        <option value="" selected>Seleccione el tipo</option>
        @foreach ($tipo_diagnostico as $key => $tipo)
            <option value="{{ $key }}" {{ ($modo == 'show' || $modo == 'edit') && $diagnostico->tipo == $key ? 'selected' : '' }}>{{ $tipo }}</option>
        @endforeach
    </select>
    <label for="tipo" class="fw-bold">Tipo <span class="text-danger">*</span></label>
</div>

