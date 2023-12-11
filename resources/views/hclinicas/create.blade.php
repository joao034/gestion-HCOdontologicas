@extends('layouts.app')
@section('content')
    <form action="{{ route('hclinicas.store') }}" method="POST">
        @csrf
        <div class="card border">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center g-2 fw-bold">Historia Clínica Odontológica</h3>

                    <!--Datos Generales-->
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Datos Personales</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Nombres</label>
                                                <input type="text" value="{{ old('nombres') }}" class="form-control"
                                                    name="nombres" id="" aria-describedby="helpId"
                                                    placeholder="Escriba los nombres del paciente" required>

                                                @error('nombres')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Apellidos</label>
                                                <input type="text" value="{{ old('apellidos') }}" class="form-control"
                                                    name="apellidos" id="" aria-describedby="helpId"
                                                    placeholder="Escriba los apellidos del paciente">

                                                @error('apellidos')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Cédula</label>
                                                <input type="text" class="form-control" name="cedula"
                                                    value="{{ old('cedula') }}" minlength="10" maxlength="10" id="cedula"
                                                    aria-describedby="helpId" placeholder="Escriba la cédula del paciente"
                                                    pattern="^[0-9]+$">

                                                @error('cedula')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Fecha de Nacimiento</label>
                                                <input type="date" value="{{ old('fecha_nacimiento') }}"
                                                    class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"
                                                    max="<?php echo date('Y-m-d'); ?>" id="fechaNacimiento" placeholder="dd/mm/aaaa"
                                                    pattern="\d{2}/\d{2}/\d{4}" required>

                                                @error('fecha_nacimiento')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Edad</label>
                                                <input type="text" value="{{ old('edad') }}" class="form-control"
                                                    name="edad" id="edad" aria-describedby="helpId" placeholder=""
                                                    readonly min="0" max="120" required>

                                                @error('edad')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>


                                        <div class="row" id="representanteDiv" style="display: none;">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Cédula del
                                                        Representante</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('cedula_representante') }}"
                                                        name="cedula_representante" minlength="10" maxlength="10"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba la cédula del representante"
                                                        pattern="^[0-9]+$">

                                                    @error('cedula_representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Representante</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('representante') }}" name="representante"
                                                        id="representante" aria-describedby="helpId"
                                                        placeholder="Nombre del representante">

                                                    @error('representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="" class="form-label fw-bold">Estado civil</label>
                                            <select name="estado_civil" id="" class="form-select form-select-md"
                                                required>

                                                <option>Seleccione el estado civil del paciente</option>
                                                <option value="soltero" {{ old('etado_civil') ? 'checked' : '' }}>
                                                    Soltero/a</option>
                                                <option value="casado" {{ old('etado_civil') ? 'checked' : '' }}>Casado/a
                                                </option>
                                                <option value="unionlibre" {{ old('etado_civil') ? 'checked' : '' }}>Unión
                                                    Libre</option>
                                                <option value="divorciado" {{ old('etado_civil') ? 'checked' : '' }}>
                                                    Divorciado/a</option>
                                                <option value="viudo" {{ old('etado_civil') ? 'checked' : '' }}>Viudo/a
                                                </option>


                                            </select>

                                            @error('estado_civil')
                                                <small class="text-danger"> {{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Género</label>
                                                <select class="form-select form-select-md" name="sexo" required
                                                    aria-label=".form-select-sm example">
                                                    <option>Seleccione el género del paciente</option>
                                                    <option value="masculino" {{ old('sexo') ? 'checked' : '' }}>
                                                        Masculino</option>
                                                    <option value="femenino" {{ old('sexo') ? 'checked' : '' }}>Femenino
                                                    </option>
                                                </select>

                                                @error('sexo')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>




                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Celular</label>
                                                <input type="text" value="{{ old('celular') }}" class="form-control"
                                                    required name="celular" minlength="10" maxlength="10" id="celular"
                                                    aria-describedby="helpId"
                                                    placeholder="Escirba el celular del paciente" pattern="^[0-9]+$">

                                                @error('celular')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Teléfono
                                                    Convencional</label>
                                                <input type="text" value="{{ old('telef_convencional') }}"
                                                    id="telefono" class="form-control" name="telef_convencional"
                                                    id="" aria-describedby="helpId" minlength="6"
                                                    maxlength="9" pattern="^[0-9]+$" placeholder="Por ejemplo: 2831373">

                                                @error('telef_convencional')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Direción
                                                    (Ciudad/Barrio)</label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="" aria-describedby="helpId"
                                                    placeholder="Escriba dónde reside el paciente"
                                                    value="{{ old('direccion') }}" required>
                                                @error('direccion')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Prefesión u
                                                    Oficio</label>
                                                <input type="text" class="form-control" name="ocupacion"
                                                    id="" aria-describedby="helpId"
                                                    placeholder="Escriba la ocupación del paciente"
                                                    value="{{ old('ocupacion') }}" required>
                                                @error('ocupacion')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Antecedentes Infecciosos-->
                        {{-- <div class="col-md-12 col-lg-6 mt-4">
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
                                        <input class="form-check-input" type="radio" name="enfermedad_respiratoria" value="0" id="radioEnfermedadSi">
                                        <label class="form-check-label" for="radioEnfermedadSi">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioEnfermedadNo"  name="enfermedad_respiratoria" value="1">
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
                                        <input class="form-check-input" type="radio" id="radioFiebreSi"  name="fiebre" value="0">
                                        <label class="form-check-label" for="radioFiebreSi">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioFiebreNo"  name="fiebre" value="1">
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
                                        <input class="form-check-input" type="radio" id="radioHospitalizadoSi"  name="hospitalizado" value="0">
                                        <label class="form-check-label" for="radioHospitalizadoSi">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioHospitalizadoNo"  name="hospitalizado" value="1">
                                        <label class="form-check-label" for="radioHospitalizadoNo">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Razón de la hospitalización</label>
                                <input type="text"
                                  class="form-control" name="razon_hospitalizacion" id="" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha sido detectado usted o algún miembro de su familia con COVID-19?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioCovidSi"  name="detectado_covid" value="0">
                                        <label class="form-check-label" for="radioCovidSi">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioCovidNo"  name="detectado_covid" value="1">
                                        <label class="form-check-label" for="radioCovidNo">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Parentesco</label>
                                    <input type="text"
                                      class="form-control" name="parentesco_covid" id="" aria-describedby="helpId" placeholder="">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p>¿En su lugar de trabajo que grado de riesgo tiene de contraer COVID-19?</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioRiesgoAlto"  name="grado_contagio" value="alto">
                                        <label class="form-check-label" for="radioRiesgoAlto">
                                            Alto
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioRiesgoMedio"  name="grado_contagio" value="medio">
                                        <label class="form-check-label" for="radioRiesgoMedio">
                                            Medio
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radioRiesgoBajo"  name="grado_contagio" value="bajo">
                                        <label class="form-check-label" for="radioRiesgoBajo">
                                            Bajo
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          </div>
                      </div>

                  </div> --}}
                    </div>

                    <!--Antecedentes Personales y Familiares-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Antecedentes Personales y Familiares</h5>
                                    <p class="fw-bold">¿USTED, SUS PADRES O ABUELOS PADECE O HA PADECIDO ALGUNA DE LAS
                                        SIGUIENTES
                                        ENFERMEDADES?</p>

                                    <div class="row">

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id="checkHipertension"
                                                name="enfermedades[]" value="hipertension">
                                            <label class="form-check-label" for="checkHipertension">
                                                Hipertensión
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id="checkEcardiacas"
                                                name="enfermedades[]" value="enfermedades cardiacas">
                                            <label class="form-check-label" for="checkEcardiacas">
                                                Enfermedades Cardiacas
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id="checkDiabetes"
                                                name="enfermedades[]" value="diabetes mellitus">
                                            <label class="form-check-label" for="checkDiabetes">
                                                Diabetes Mellitus
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id="checkHepatitis"
                                                name="enfermedades[]" value="hepatitis">
                                            <label class="form-check-label" for="checkHepatitis">
                                                Hepatitis
                                            </label>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkFiebreReumatica" name="enfermedades[]"
                                                        value="fiebre reumatica">
                                                    <label class="form-check-label" for="checkFiebreReumatica">
                                                        Fiebre Reumática
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkTuberculosis"
                                                    name="enfermedades[]" value="tuberculosis">
                                                <label class="form-check-label" for="checkTuberculosis">
                                                    Tuberculosis
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkAsma"
                                                    name="enfermedades[]" value="asma">
                                                <label class="form-check-label" for="checkAsma">
                                                    Asma
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkHemorragias"
                                                    name="enfermedades[]" value="hemorragias">
                                                <label class="form-check-label" for="checkHemorragias">
                                                    Hemorragias
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkEpilepsias"
                                                        name="enfermedades[]" value="epilepsias">
                                                    <label class="form-check-label" for="checkEpilepsias">
                                                        Epilepsias
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 mb-2">
                                                <input class="form-check-input" type="checkbox" id="checkAlergias"
                                                    name="enfermedades[]" value="alergias">
                                                <label class="form-check-label" for="checkAlergias">
                                                    Alergias
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="otra_enfermedad"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba otra enfermedad">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="parentesco"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Parentesco">
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

                                            <div class="col-md-6 col-lg-4">
                                                <div class="mb-3">
                                                    <input type="number" class="form-control" name="semanas_embarazo"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Digite las semanas de embarazo">
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
                                                    <input class="form-check-input" type="checkbox" id="checkTabaquismo"
                                                        name="habitos[]" value="tabaquismo">
                                                    <label class="form-check-label" for="checkTabaquismo">
                                                        Tabaquismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkAlcohol"
                                                    name="habitos[]" value="alcohol">
                                                <label class="form-check-label" for="checkAlcohol">
                                                    Alcohol
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkDuglucion"
                                                    name="habitos[]" value="duglucion atipica">
                                                <label class="form-check-label" for="checkDuglucion">
                                                    Duglución atípica
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkRespiracion"
                                                    name="habitos[]" value="respiracion bucal">
                                                <label class="form-check-label" for="checkRespiracion">
                                                    Respiración bucal
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkBruxismo"
                                                        name="habitos[]" value="bruxismo">
                                                    <label class="form-check-label" for="checkBruxismo">
                                                        Bruxismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id="checkSuccionDigital"
                                                    name="habitos[]" value="succion digital">
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

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                                    Guardar Historia Clínica</button>
                            </div>


                        </div>

                    </div>
                </div>


    </form>

    <script>
        $(document).ready(function() {
            // Obtener los elementos necesarios
            const fechaInput = $('#fecha_nacimiento');
            const edadInput = $('#edad');
            const representanteDiv = $('#representanteDiv');


            function calcularEdad(nacimiento) {
                const fechaNacimiento = new Date(nacimiento);
                const fechaActual = new Date();
                let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

                const mesActual = fechaActual.getMonth() + 1;
                const mesNacimiento = fechaNacimiento.getMonth() + 1;

                if (mesNacimiento > mesActual || (mesNacimiento === mesActual &&
                        fechaNacimiento.getDate() > fechaActual.getDate())) {
                    edad--;
                }
                return edad;
            }

            function controlarVisibilidadRepresentante() {
                const edad = parseInt(edadInput.val());

                if (edad < 12) {
                    representanteDiv.show();
                } else {
                    representanteDiv.hide();
                }
            }
            // Evento que se dispara al cambiar el valor del input de fecha
            fechaInput.on('change', function() {
                // Obtener el valor de la fecha de nacimiento
                const fechaNacimiento = fechaInput.val();

                // Calcular la edad y actualizar el input correspondiente
                const edad = calcularEdad(fechaNacimiento);
                edadInput.val(edad);

                // Controlar la visibilidad del div del representante según la edad calculada
                controlarVisibilidadRepresentante();
            });
        });
    </script>

    <script>
        let cedulaInput = document.getElementById('cedula');
        apply_input_filter(cedulaInput);

        let celularInput = document.getElementById('celular');
        apply_input_filter(celularInput);

        let telefonoInput = document.getElementById('telefono');
        apply_input_filter(telefonoInput);


        function apply_input_filter(input) {
            input.addEventListener('input', function() {
                // Filtrar y mantener solo los dígitos
                const filteredValue = this.value.replace(/\D/g, '');
                this.value = filteredValue;
            });
        }
    </script>
@endsection
