@php
    $grados_enfermedad_periodontal = [
        'Ninguna' => 'Ninguna',
        'Leve' => 'Leve',
        'Moderada' => 'Moderada',
        'Severa' => 'Severa',
    ];

    $tipos_oclusion = [
        'Angle I' => 'Angle I',
        'Angle II' => 'Angle II',
        'Angle III' => 'Angle III',
    ];

    $nivel_fluorosis = [
        'Ninguna' => 'Ninguna',
        'Leve' => 'Leve',
        'Moderada' => 'Moderada',
        'Severa' => 'Severa',
    ];
@endphp

<div class="d-flex flex-wrap">
    <div class="form-floating">
        @if ($modo == 'show')
            <input type="text" class="form-control" id="floatingInputValue"
                value="{{ $odontograma?->indicadores_salud?->enfermedad_periodontal }}" readonly>
            <label for="floatingInputValue" class="fw-bold">Enfermedad periodontal</label>
        @else
            <select class="form-select" id="floatingSelect" name="enfermedad_periodontal"
                aria-label="Floating label select example" required>
                <option selected value="">Seleccione el tipo </option>
                @foreach ($grados_enfermedad_periodontal as $key => $value)
                    <option value="{{ $key }}"
                        {{ $odontograma?->indicadores_salud?->enfermedad_periodontal == $key ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Enfermedad periodontal <span class="text-danger">*</span></label>
        @endif
    </div>
    <div class="form-floating">
        @if ($modo == 'show')
            <input type="text" class="form-control" id="floatingInputValue"
                value="{{ $odontograma?->indicadores_salud?->tipo_oclusion }}" readonly>
            <label for="floatingInputValue" class="fw-bold">Tipo de oclusión</label>
        @else
            <select class="form-select" id="floatingSelect" name="tipo_oclusion"
                aria-label="Floating label select example" required>
                <option selected value="">Seleccione un tipo</option>
                @foreach ($tipos_oclusion as $key => $value)
                    <option value="{{ $key }}"
                        {{ $odontograma?->indicadores_salud?->tipo_oclusion == $key ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Tipo de oclusión <span class="text-danger">*</span></label>
        @endif
    </div>
    <div class="form-floating">
        @if ($modo == 'show')
            <input type="text" class="form-control" id="floatingInputValue"
                value="{{ $odontograma?->indicadores_salud?->nivel_fluorosis }}" readonly>
            <label for="floatingInputValue" class="fw-bold">Nivel de fluorosis</label>
        @else
            <select class="form-select" id="floatingSelect" name="nivel_fluorosis"
                aria-label="Floating label select example" required>
                <option selected value="">Seleccione un tipo</option>
                @foreach ($nivel_fluorosis as $key => $value)
                    <option value="{{ $key }}"
                        {{ $odontograma?->indicadores_salud?->nivel_fluorosis == $key ? 'selected' : '' }}>
                        {{ $value }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Nivel de fluorosis <span class="text-danger">*</span></label>
        @endif
    </div>
</div>
