@extends('layouts.app')
@section('content')
    <form action="{{ route('hclinicas.store') }}" method="POST">
        @csrf
        <div class="card border">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center g-2 fw-bold">Historia Clínica Odontológica</h3>

                    @include('hclinicas.components.datos_personales', ['modo' => 'create'])

                    <!--Antecedentes Personales y Familiares-->
                    {{-- <div class="row mt-4">
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
                                            <input class="form-check-input border-primary" type="checkbox"
                                                id="checkHipertension" name="enfermedades[]" value="hipertension">
                                            <label class="form-check-label" for="checkHipertension">
                                                Hipertensión
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input border-primary" type="checkbox"
                                                id="checkEcardiacas" name="enfermedades[]" value="enfermedades cardiacas">
                                            <label class="form-check-label" for="checkEcardiacas">
                                                Enfermedades Cardiacas
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input border-primary" type="checkbox"
                                                id="checkDiabetes" name="enfermedades[]" value="diabetes mellitus">
                                            <label class="form-check-label" for="checkDiabetes">
                                                Diabetes Mellitus
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input border-primary" type="checkbox"
                                                id="checkHepatitis" name="enfermedades[]" value="hepatitis">
                                            <label class="form-check-label" for="checkHepatitis">
                                                Hepatitis
                                            </label>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input border-primary" type="checkbox"
                                                        id="checkFiebreReumatica" name="enfermedades[]"
                                                        value="fiebre reumatica">
                                                    <label class="form-check-label" for="checkFiebreReumatica">
                                                        Fiebre Reumática
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkTuberculosis" name="enfermedades[]" value="tuberculosis">
                                                <label class="form-check-label" for="checkTuberculosis">
                                                    Tuberculosis
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkAsma" name="enfermedades[]" value="asma">
                                                <label class="form-check-label" for="checkAsma">
                                                    Asma
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkHemorragias" name="enfermedades[]" value="hemorragias">
                                                <label class="form-check-label" for="checkHemorragias">
                                                    Hemorragias
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input border-primary" type="checkbox"
                                                        id="checkEpilepsias" name="enfermedades[]" value="epilepsias">
                                                    <label class="form-check-label" for="checkEpilepsias">
                                                        Epilepsias
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-2">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkAlergias" name="enfermedades[]" value="alergias">
                                                <label class="form-check-label" for="checkAlergias">
                                                    Alergias
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="otra_enfermedad"
                                                        id="otra_enfermedad" aria-describedby="helpId"
                                                        placeholder="Escriba otra enfermedad">
                                                    <label for="otra_enfermedad" class="fw-bold">Otra
                                                        Enfermedad</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="parentesco"
                                                        id="parentesco" aria-describedby="helpId"
                                                        placeholder="Parentesco">
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
                                                        name="embarazada" value="0">
                                                    <label class="form-check-label" for="radioEmbarazadaSi">
                                                        Sí
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="col-lg-1 col-md-5">
                                                <div class="col-sm">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            id="radioEmbarazadaNo" name="embarazada" value="1">
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
                                                        style="display: none;" aria-describedby="helpId"
                                                        placeholder="Ejemplo: 16">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Toma algún
                                                        medicamento?</label>
                                                    <input type="text" class="form-control" name="medicamento"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba el o los medicamentos que toma.">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Algún otro
                                                        antecedente?</label>
                                                    <input type="text" class="form-control" name="otro_antecedente"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba si posee otro antecedente que no se encuentre en la lista.">
                                                </div>
                                            </div>
                                        </div>

                                        <h6 class="fw-bold">HÁBITOS (Seleccione los hábitos del paciente)</h6>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input border-primary" type="checkbox"
                                                        id="checkTabaquismo" name="habitos[]" value="tabaquismo">
                                                    <label class="form-check-label" for="checkTabaquismo">
                                                        Tabaquismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkAlcohol" name="habitos[]" value="alcohol">
                                                <label class="form-check-label" for="checkAlcohol">
                                                    Alcohol
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkDuglucion" name="habitos[]" value="duglucion atipica">
                                                <label class="form-check-label" for="checkDuglucion">
                                                    Duglución atípica
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkRespiracion" name="habitos[]" value="respiracion bucal">
                                                <label class="form-check-label" for="checkRespiracion">
                                                    Respiración bucal
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input border-primary" type="checkbox"
                                                        id="checkBruxismo" name="habitos[]" value="bruxismo">
                                                    <label class="form-check-label" for="checkBruxismo">
                                                        Bruxismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="checkSuccionDigital" name="habitos[]" value="succion digital">
                                                <label class="form-check-label" for="checkSuccionDigital">
                                                    Succión Digital
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="otro_habito"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba otro hábito">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @include('hclinicas.components.antecedentes_personales', ['modo' => 'create'])
                    <!--Fin Antecedentes Personales y Familiares-->

                    <!--Diagnostico-->

                    @include('hclinicas.components.diagnostico', ['modo' => 'create'])
                    {{-- <div class="row justify-content-center mt-4">
                        <div class="col-md-12 col-lg-12">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Diagnóstico</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="diagnostico"
                                                    id="diganostico" aria-describedby="helpId"
                                                    placeholder="Escriba el diagnóstico" value="{{ old('diagnostico') }}">
                                                <label for="diganostico" class="fw-bold">Diagnóstico</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="enfermedad_actual"
                                                    id="enfermedad_actual" aria-describedby="helpId"
                                                    placeholder="Escriba la enfermedad actual"
                                                    value="{{ old('enfermedad_actual') }}">
                                                <label for="enfermedad_actual" class="fw-bold">Enfermedad
                                                    Actual</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--Fin Diagnostico-->
                    <!--Consentimiento-->
                    <div class="form-check mt-2">
                        <input class="form-check-input border-primary" type="checkbox" id="consentimiento"
                            name="consentimiento" required value="1" {{ old('consentimiento') ? 'checked' : '' }}>

                        <label class="form-check-label" for="consentimiento">
                            Acepto de manera libre y voluntaria dar mi consentimiento para la recolección, procesamiento
                            y
                            uso de mis datos personales con fines médicos y en el contexto de la historia clínica
                            odontológica.
                        </label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                            Guardar Historia Clínica</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('assets/js/controles_hclinica.js') }}"> </script>
@endsection
