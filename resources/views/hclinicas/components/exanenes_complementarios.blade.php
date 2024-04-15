<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">L. PEDIDO DE EXÁMENES COMPLEMENTARIOS</h5>
        <hr>
        <div class="form-floating mt-2">
            <textarea class="form-control" style="height: 80px" id="examenes_solicitados" name="examenes_solicitados"
                required {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $hClinica->examenesComplementarios?->examenes_solicitados : old('examenes_solicitados') }}</textarea>
            <label for="examenes_solicitados" class="fw-bold">Exámenes solicitados <span class="text-danger">*</span>
            </label>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">M. INFORME DE EXÁMENES</h5>
        <hr>
        @php
            $examenes = [
                'biometria' => 'BIOMETRIA',
                'quimica sanguinea' => 'QUIMICA SANGUINEA',
                'rayos-x' => 'RAYOS-X',
                'otros' => 'OTROS',
            ];
        @endphp
        <div class="row">
            @foreach ($examenes as $key => $examen)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input border-primary" type="checkbox" id="checkbox{{ $key }}"
                            name="tipos_examen[]" value="{{ $key }}"
                            {{ ($modo == 'show' || $modo == 'edit') && $hClinica->examenesComplementarios?->retornar_tipos_examen($key) == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox{{ $key }}">{{ $examen }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-floating mt-2">
            <textarea class="form-control" style="height: 80px" name="observaciones"
                required {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $hClinica->examenesComplementarios?->observaciones : old('observaciones') }}</textarea>
            <label for="observaciones" class="fw-bold">Observaciones <span class="text-danger">*</span>
            </label>
        </div>
    </div>
</div>
