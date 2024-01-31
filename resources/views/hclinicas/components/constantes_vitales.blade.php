<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">F. CONSTANTES VITALES</h5>
        <hr>

        @php
            $constantes_vitales = [
                'presion_arterial' => 'Presión arterial',
                'frecuencia_cardiaca' => 'Frecuencia cardiaca',
                'frecuencia_respiratoria' => 'Frecuencia respiratoria',
                'temperatura' => 'Temperatura ºC',
            ];
        @endphp

        <div class="row">
            @foreach ($constantes_vitales as $key => $constante)
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder=""  value="{{ $modo == 'show' || $modo == 'edit' ?  $paciente->consulta?->$key : old($key) }}"
                        {{ $modo == 'show' ? 'readonly' : '' }}
                            name="{{ $key }}" required>
                        <label for="floatingInput" class="fw-bold">{{ $constante }}<span
                                class="text-danger">*</span></label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
