<div class="row mt-4">
    <div class="col-12">
        <div class="card text-start">
            <div class="card-body">
                <h5 class="card-title fw-bolder">Antecedentes Personales y Familiares</h5>
                <hr>
                <p class="fw-bold">¿USTED, SUS PADRES O ABUELOS PADECE O HA PADECIDO ALGUNA DE LAS
                    SIGUIENTES
                    ENFERMEDADES?</p>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <input class="form-check-input border-primary" type="checkbox" id="checkHipertension"
                            name="enfermedades[]" value="hipertension" value="hipertension"
                            {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('hipertension') == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkHipertension">
                            Hipertensión
                        </label>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <input class="form-check-input border-primary" type="checkbox" id="checkEcardiacas"
                            name="enfermedades[]" value="enfermedades cardiacas"
                            {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('enfermedades cardiacas') == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkEcardiacas">
                            Enfermedades Cardiacas
                        </label>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <input class="form-check-input border-primary" type="checkbox" id="checkDiabetes"
                            name="enfermedades[]" value="diabetes mellitus"
                            {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('diabetes mellitus') == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkDiabetes">
                            Diabetes Mellitus
                        </label>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <input class="form-check-input border-primary" type="checkbox" id="checkHepatitis"
                            name="enfermedades[]" value="hepatitis"
                            {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('hepatitis') == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkHepatitis">
                            Hepatitis
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-check">
                                <input class="form-check-input border-primary" type="checkbox" id="checkFiebreReumatica"
                                    name="enfermedades[]" value="fiebre reumatica"
                                    {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('fiebre reumatica') == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkFiebreReumatica">
                                    Fiebre Reumática
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkTuberculosis"
                                name="enfermedades[]" value="tuberculosis"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('tuberculosis') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkTuberculosis">
                                Tuberculosis
                            </label>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkAsma"
                                name="enfermedades[]" value="asma"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('asma') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkAsma">
                                Asma
                            </label>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkHemorragias"
                                name="enfermedades[]" value="hemorragias"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('hemorragias') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkHemorragias">
                                Hemorragias
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-check">
                                <input class="form-check-input border-primary" type="checkbox" id="checkEpilepsias"
                                    name="enfermedades[]" value="epilepsias"
                                    {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('epilepsias') == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkEpilepsias">
                                    Epilepsias
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-2">
                            <input class="form-check-input border-primary" type="checkbox" id="checkAlergias"
                                name="enfermedades[]" value="alergias"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_enfermedades('alergias') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkAlergias">
                                Alergias
                            </label>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="otra_enfermedad" id="otra_enfermedad"
                                    aria-describedby="helpId" placeholder="Escriba otra enfermedad"
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->otra_enfermedad : old('otra_enfermedad') }}" {{ $modo == 'show' ? 'readonly' : '' }}>
                                <label for="otra_enfermedad" class="fw-bold">Otra
                                    Enfermedad</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="parentesco" id="parentesco"
                                    aria-describedby="helpId" placeholder="Parentesco"
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->otra_enfermedad : old('otra_enfermedad') }}" {{ $modo == 'show' ? 'readonly' : '' }}>
                                <label for="parentesco" class="fw-bold">Parentesco</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <p class="fw-bold">¿Está Ud embarazada?</p>
                        </div>
                        <div class="col-lg-1 col-md-5">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="radioEmbarazadaSi"
                                    name="embarazada" value="0"
                                    {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->embarazada == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radioEmbarazadaSi">
                                    Sí
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-5">
                            <div class="col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="radioEmbarazadaNo"
                                        name="embarazada" value="1"
                                        {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->embarazada == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="radioEmbarazadaNo">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4" id="embarazada">
                            <div class="input-group mb-3">
                                <span class="input-group-text fw-bold" id="basic-addon1">Semanas
                                    de
                                    embarazo</span>
                                <input type="number" class="form-control" name="semanas_embarazo"
                                    aria-describedby="helpId" placeholder="Ejemplo: 16" min="1"
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->semanas_embarazo : old('semanas_embarazo') }}" {{ $modo == 'show' ? 'readonly' : '' }} >
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">¿Toma algún
                                    medicamento?</label>
                                <input type="text" class="form-control" name="medicamento" id=""
                                    aria-describedby="helpId" placeholder="Escriba el o los medicamentos que toma."
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->medicamento : old('medicamento') }}" {{ $modo == 'show' ? 'readonly' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">¿Algún otro
                                    antecedente?</label>
                                <input type="text" class="form-control" name="otro_antecedente" id=""
                                    aria-describedby="helpId"
                                    placeholder="Escriba si posee otro antecedente que no se encuentre en la lista."
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->otro_antecedente : old('otro_antecedente') }}" {{ $modo == 'show' ? 'readonly' : '' }}> 
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold">HÁBITOS (Seleccione los hábitos del paciente)</h6>

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-check">
                                <input class="form-check-input border-primary" type="checkbox" id="checkTabaquismo"
                                    name="habitos[]" value="tabaquismo"
                                    {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('tabaquismo') == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkTabaquismo">
                                    Tabaquismo
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkAlcohol"
                                name="habitos[]" value="alcohol"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('alcohol') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkAlcohol">
                                Alcohol
                            </label>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkDuglucion"
                                name="habitos[]" value="duglucion atipica"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('duglucion atipica') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkDuglucion">
                                Duglución atípica
                            </label>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkRespiracion"
                                name="habitos[]" value="respiracion bucal"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('respiracion bucal') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkRespiracion">
                                Respiración bucal
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-check">
                                <input class="form-check-input border-primary" type="checkbox" id="checkBruxismo"
                                    name="habitos[]" value="bruxismo"
                                    {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('bruxismo') == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkBruxismo">
                                    Bruxismo
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <input class="form-check-input border-primary" type="checkbox" id="checkSuccionDigital"
                                name="habitos[]" value="succion digital"
                                {{ ($modo == 'show' || $modo == 'edit') && $antPersonales?->retornar_habitos('succion digital') == true ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkSuccionDigital">
                                Succión Digital
                            </label>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="otro_habito" id=""
                                    aria-describedby="helpId" placeholder="Escriba otro hábito"
                                    value="{{ $modo == 'show' || $modo == 'edit' ? $antPersonales?->otro_habito : old('otro_habito') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
