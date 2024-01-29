<!--No se utiliza-->
<div class="col-md-12 col-lg-6 mt-4">
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title fw-bolder">Antecedentes Infecciosos</h5>

            <div class="row">
                <div class="col-md-9">
                    <p>¿Ha presentado alguna enfermedad respiratoria en los últimos 4 meses?</p>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                name="enfermedad_respiratoria" value="0"
                                id="radioEnfermedadSi">
                            <label class="form-check-label" for="radioEnfermedadSi">
                                Sí
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioEnfermedadNo"
                                name="enfermedad_respiratoria" value="1">
                            <label class="form-check-label" for="radioEnfermedadNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <p>¿Ha presentado fiebre los últimos 4 meses?</p>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioFiebreSi"
                                name="fiebre" value="0">
                            <label class="form-check-label" for="radioFiebreSi">
                                Sí
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioFiebreNo"
                                name="fiebre" value="1">
                            <label class="form-check-label" for="radioFiebreNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <p>¿Ha sido hospitalizado por alguna razón los últimos 4 meses?</p>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="radioHospitalizadoSi" name="hospitalizado" value="0">
                            <label class="form-check-label" for="radioHospitalizadoSi">
                                Sí
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="radioHospitalizadoNo" name="hospitalizado" value="1">
                            <label class="form-check-label" for="radioHospitalizadoNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label for="" class="form-label">Razón de la hospitalización</label>
                <input type="text" class="form-control" name="razon_hospitalizacion"
                    id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="row">
                <div class="col-md-9">
                    <p>¿Ha sido detectado usted o algún miembro de su familia con COVID-19?</p>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioCovidSi"
                                name="detectado_covid" value="0">
                            <label class="form-check-label" for="radioCovidSi">
                                Sí
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioCovidNo"
                                name="detectado_covid" value="1">
                            <label class="form-check-label" for="radioCovidNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 col-6">
                    <label for="" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" name="parentesco_covid"
                        id="" aria-describedby="helpId" placeholder="">
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <p>¿En su lugar de trabajo que grado de riesgo tiene de contraer COVID-19?</p>
                </div>
                <div class="col-md-2">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioRiesgoAlto"
                                name="grado_contagio" value="alto">
                            <label class="form-check-label" for="radioRiesgoAlto">
                                Alto
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioRiesgoMedio"
                                name="grado_contagio" value="medio">
                            <label class="form-check-label" for="radioRiesgoMedio">
                                Medio
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="col-sm">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="radioRiesgoBajo"
                                name="grado_contagio" value="bajo">
                            <label class="form-check-label" for="radioRiesgoBajo">
                                Bajo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>