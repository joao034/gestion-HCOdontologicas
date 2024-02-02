<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">D. ANTECEDENTES PATOLÓGICOS PERSONALES</h5>
        <hr>
        @php
            $antecedentes_personales = [
                'alergia_antibiotico' => '1. ALERGIA ANTIBIÓTICO',
                'alergia_anestesia' => '2. ALERGIA ANESTESIA',
                'hemorragias' => '3. HEMORRAGIAS',
                'vih/sida' => '4. VIH/SIDA',
                'tuberculosis' => '5. TUBERCULOSIS',
                'asma'=> '6. ASMA',
                'diabetes' => '7. DIABETES',
                'hipertension_arterial' => '8. HIPERTENSIÓN ARTERIAL',
                'enfermedad_cardiaca' => '9. ENFERMEDAD CARDIACA',
                'otro' => '10. OTRO',
            ];
        @endphp
        <div class="row">
            @foreach ($antecedentes_personales as $key => $ant_personal)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input border-primary" type="checkbox" id="checkbox{{ $key }}"
                            name="ant_personales[]" value="{{ $key }}"
                            {{ ($modo == 'show' || $modo == 'edit') && $paciente->antecedentes_patologicos?->validar_checks_personales($key) == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox{{ $key }}">{{ $ant_personal }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-floating mt-2">
            <textarea class="form-control" style="height: 80px" name="desc_personales"
                required {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->antecedentes_patologicos?->desc_personales : old('desc_personales') }}</textarea>
            <label for="desc_personales" class="fw-bold fs-5">Descripción <span class="text-danger">* <span class="info_extra fs-6">(En el caso de no presentar antecedentes se anotará 'No refiere antecedentes')</span></span>
            </label>
        </div>

    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">E. ANTECEDENTES PATOLÓGICOS FAMILIARES</h5>
        <hr>
        @php
            $antecedentes_familiares = [
                'cardiopatia' => '1. CARDIOPATÍA',
                'hipertension_arterial' => '2. HIPERTENSIÓN ARTERIAL',
                'enf_card_vascular' => '3. ENF. CARDIOVASCULAR',
                'endocrino_metabolico' => '4. ENDOCRINO METABÓLICO',
                'cancer' => '5. CÁNCER',
                'tuberculosis'=> '6. TUBERCULOSIS',
                'enf_mental' => '7. ENF. MENTAL',
                'enf_infecciosa' => '8. ENF. INFECCIOSA',
                'mal_formacion' => '9. MALFORMACIÓN',
                'otro' => '10. OTRO',
            ];
        @endphp
        <div class="row">
            @foreach ($antecedentes_familiares as $key => $ant_familiar)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input border-primary" type="checkbox" id="checkbox{{ $key }}"
                            name="ant_familiares[]" value="{{ $key }}"
                            {{ ($modo == 'show' || $modo == 'edit') && $paciente->antecedentes_patologicos?->validar_checks_familiares($key)== true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox{{ $key }}">{{ $ant_familiar }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-floating mt-2">
            <textarea class="form-control" style="height: 80px" name="desc_familiares"
                required {{ $modo == 'show' ? 'readonly' : '' }}>{{ $modo == 'show' || $modo == 'edit' ? $paciente->antecedentes_patologicos?->desc_familiares : old('desc_familiares') }}</textarea>
            <label for="observaciones" class="fw-bold fs-5">Descripción <span class="text-danger">* <span class="info_extra fs-6">(En el caso de no presentar antecedentes se anotará 'No refiere antecedentes')</span></span>
            </label>
        </div>

    </div>
</div>


