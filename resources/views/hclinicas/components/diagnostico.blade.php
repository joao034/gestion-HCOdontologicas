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
    <label for="diagnostico" class="fw-bold">Diagnóstico</label>
</div>


<div class="form-floating mb-2">
    <input type="text" class="form-control" name="CIE" id="diagnostico" required aria-describedby="helpId" value="{{ isset($diagnostico) ? $diagnostico->CIE : '' }}"
        placeholder="CIE" {{ $modo == 'show' ? 'readonly' : '' }}>
    <label for="diagnostico" class="fw-bold">CIE</label>

</div>

<div class="form-floating mb-2">
    <select class="form-select" name="tipo" required id="tipo" {{ $modo == 'show' ? 'disabled' : '' }}>
        <option value="" selected>Seleccione</option>
        @foreach ($tipo_diagnostico as $key => $tipo)
            <option value="{{ $key }}" {{ ($modo == 'show' || $modo == 'edit') && $diagnostico->tipo == $key ? 'selected' : '' }}>{{ $tipo }}</option>
        @endforeach
    </select>
    <label for="tipo" class="fw-bold">Tipo</label>
</div>

