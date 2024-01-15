@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form method="post" action="{{ route('hclinicas.update', $paciente->id) }}">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center fw-bold">Historia Clínica Odontológica Editable</h3>

                    <!--Datos Generales-->
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Datos Personales</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Nombres</label>
                                                <input type="text" class="form-control" name="nombres" id=""
                                                    aria-describedby="helpId" placeholder="" required
                                                    value="{{ $paciente->nombres }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos" id=""
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->apellidos }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Cédula</label>
                                                <input type="text" class="form-control" name="cedula" minlength="10"
                                                    maxlength="10" id="cedula" aria-describedby="helpId" placeholder=""
                                                    required value="{{ $paciente->cedula }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Fecha de Nacimiento</label>
                                                <input type="date" id="fecha_nacimiento"
                                                    value="{{ $paciente->fecha_nacimiento }}" class="form-control"
                                                    max="<?php echo date('Y-m-d'); ?>" name="fecha_nacimiento" id="fechaNacimiento"
                                                    placeholder="dd-mm-aaaa" pattern="\d{4}-\d{2}-\d{2}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Edad</label>
                                                <input type="text" class="form-control" name="edad" id="edad"
                                                    aria-describedby="helpId" placeholder="" readonly
                                                    value="{{ $paciente->edad }}">
                                            </div>
                                        </div>
                                    </div>

                                    @if ($paciente->edad < 12 && $representante)
                                        <div class="row" id="representanteDiv">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Cédula del
                                                        Representante</label>
                                                    <input type="text" class="form-control" name="cedula_representante"
                                                        minlength="10" maxlength="10" id=""
                                                        aria-describedby="helpId" placeholder="" pattern="^[0-9]+$"
                                                        value="{{ $representante->cedula_representante }}">

                                                    @error('cedula_representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Representante</label>
                                                    <input type="text" class="form-control" name="representante"
                                                        id="representante" value="{{ $representante->representante }}"
                                                        aria-describedby="helpId" placeholder="Nombre del representante">

                                                    @error('representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="" class="form-label fw-bold">Estado civil</label>
                                            <select name="estado_civil" id="" class="form-select form-select-md"
                                                required>

                                                <option>Seleccione el estado civil del paciente</option>
                                                <option value="soltero"
                                                    {{ $paciente->estado_civil === 'soltero' ? 'selected' : '' }}>
                                                    Soltero/a</option>
                                                <option value="casado"
                                                    {{ $paciente->estado_civil === 'casado' ? 'selected' : '' }}>Casado/a
                                                </option>
                                                <option value="unionlibre"
                                                    {{ $paciente->estado_civil === 'unionlibre' ? 'selected' : '' }}>Unión
                                                    Libre</option>
                                                <option value="divorciado"
                                                    {{ $paciente->estado_civil === 'divorciado' ? 'selected' : '' }}>
                                                    Divorciado/a</option>
                                                <option value="viudo"
                                                    {{ $paciente->estado_civil === 'viudo' ? 'selected' : '' }}>Viudo/a
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
                                                    aria-label=".form-select-md example">
                                                    <option value="masculino"
                                                        {{ $paciente->sexo === 'masculino' ? 'selected' : '' }}>
                                                        Masculino</option>
                                                    <option value="femenino"
                                                        {{ $paciente->sexo === 'femenino' ? 'selected' : '' }}>
                                                        Femenino</option>
                                                    <option value="otro"
                                                        {{ $paciente->sexo === 'otro' ? 'selected' : '' }}>
                                                        Otro</option>
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
                                                <input type="text" class="form-control" name="celular" minlength="10"
                                                    id="celular" minlength="10" maxlength="10"
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->celular }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Teléfono
                                                    Convencional</label>
                                                <input type="text" class="form-control" name="telef_convencional"
                                                    id="telefono" aria-describedby="helpId" maxlength="9"
                                                    placeholder="Por ejemplo: 2831373"
                                                    value="{{ $paciente->telef_convencional }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Direción</label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->direccion }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Profesión u
                                                    Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->ocupacion }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Antecedentes Infecciosos-->
                        {{-- <div class="col-md-12 col-lg-6 mt-3">
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
                                        <input class="form-check-input" type="radio" name="enfermedad_respiratoria" value="0" {{ $antInfecciosos['enfermedad_respiratoria'] == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="enfermedad_respiratoria" value="1" {{ $antInfecciosos['enfermedad_respiratoria'] == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
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
                                        <input class="form-check-input" type="radio" id=""  name="fiebre" value="0" {{ $antInfecciosos['fiebre'] == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="fiebre" value="1" {{ $antInfecciosos['fiebre'] == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
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
                                        <input class="form-check-input" type="radio" id=""  name="hospitalizado" value="0" {{ $antInfecciosos['hospitalizado'] == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="hospitalizado" value="1" {{ $antInfecciosos['hospitalizado'] == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Razón de la hospitalización</label>
                                <input type="text"
                                  class="form-control" name="razon_hospitalizacion" id="" aria-describedby="helpId" placeholder="" value="{{$antInfecciosos->razon_hospitalizacion}}">
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <p>¿Ha sido detectado usted o algún miembro de su familia con COVID-19?</p>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="detectado_covid" value="0" {{ $antInfecciosos['hospitalizado'] == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Sí
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="detectado_covid" value="1" {{ $antInfecciosos['hospitalizado'] == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            No
                                        </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="" class="form-label">Parentesco</label>
                                    <input type="text"
                                      class="form-control" name="parentesco_covid" id="" aria-describedby="helpId" placeholder="" value="{{$antInfecciosos->parentesco_covid}}">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p>¿En su lugar de trabajo que grado de riesgo tiene de contraer COVID-19?</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="alto" {{ $antInfecciosos['grado_contagio'] == 'alto' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Alto
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="medio" {{ $antInfecciosos['grado_contagio'] == 'medio' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Medio
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-sm">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" id=""  name="grado_contagio" value="bajo" {{ $antInfecciosos['grado_contagio'] == 'bajo' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
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
                                    <hr>
                                    <p class="fw-bold">¿USTED, SUS PADRES O ABUELOS PADECE O HA PADECIDO ALGUNA DE LAS
                                        SIGUIENTES
                                        ENFERMEDADES?</p>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hipertension"
                                                {{ $antPersonales?->retornar_enfermedades('hipertension') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hipertension">
                                                Hipertensión
                                            </label>

                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="enfermedades cardiacas"
                                                {{ $antPersonales?->retornar_enfermedades('enfermedades cardiacas') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Enfermedades Cardiacas
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="diabetes mellitus"
                                                {{ $antPersonales?->retornar_enfermedades('diabetes mellitus') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Diabetes Mellitus
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hepatitis"
                                                {{ $antPersonales?->retornar_enfermedades('hepatitis') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Hepatitis
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="enfermedades[]" value="fiebre reumatica"
                                                    {{ $antPersonales?->retornar_enfermedades('fiebre reumatica') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Fiebre Reumática
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="tuberculosis"
                                                {{ $antPersonales?->retornar_enfermedades('tuberculosis') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Tuberculosis
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="asma"
                                                {{ $antPersonales?->retornar_enfermedades('asma') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Asma
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hemorragias"
                                                {{ $antPersonales?->retornar_enfermedades('hemorragias') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Hemorragias
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="enfermedades[]" value="epilepsias"
                                                    {{ $antPersonales?->retornar_enfermedades('epilepsias') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Epilepsias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="alergias"
                                                {{ $antPersonales?->retornar_enfermedades('alergias') == true ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">
                                                Alergias
                                            </label>
                                        </div>

                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="otra_enfermedad"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales?->otra_enfermedad }}"
                                                    placeholder="Otra Enfermedad">
                                                <label for="otra_enfermedad" class="fw-bold">Otra Enfermedad</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="parentesco"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales?->parentesco }}" placeholder="Parentesco">
                                                <label for="parentesco" class="fw-bold">Parentesco</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-3 col-md-4">
                                            <p class="fw-bold">¿Está Ud embarazada?</p>
                                        </div>
                                        <div class="col-lg-1 col-md-5">
                                            <div class="col-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="radioEmbarazadaSi"
                                                        name="embarazada" value="0"
                                                        {{ $antPersonales?->embarazada == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="radioEmbarazadaSi">
                                                        Sí
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-5">
                                            <div class="col-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="radioEmbarazadaSi"
                                                        name="embarazada" value="1"
                                                        {{ $antPersonales?->embarazada == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="radioEmbarazadaNo">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-lg-4" id="embarazada">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text fw-bold" id="basic-addon1">Semanas de
                                                    embarazo</span>
                                                <input type="number" class="form-control" name="semanas_embarazo"
                                                    id="semanas_embarazo" aria-describedby="helpId"
                                                    style="{{ $antPersonales?->embarazada == '0' ? 'display: block' : 'display: none' }}"
                                                    placeholder="Ejemplo: 16"
                                                    value="{{ $antPersonales?->semanas_embarazo }}">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Toma algún
                                                        medicamento?</label>
                                                    <input type="text" class="form-control" name="medicamento"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba el o los medicamentos que toma."
                                                        value="{{ $antPersonales?->medicamento }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Algún otro
                                                        antecedente?</label>
                                                    <input type="text" class="form-control" name="otro_antecedente"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Escriba si posee otro antecedente que no se encuentre en la lista."
                                                        value="{{ $antPersonales?->otro_antecendente }}">
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="fw-bold">HÁBITOS (Seleccione los hábitos del paciente)</h6>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id=""
                                                        name="habitos[]" value="tabaquismo"
                                                        {{ $antPersonales?->retornar_habitos('tabaquismo') == true ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="">
                                                        Tabaquismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="alcohol"
                                                    {{ $antPersonales?->retornar_habitos('alcohol') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Alcohol
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="duglucion atipica"
                                                    {{ $antPersonales?->retornar_habitos('duglucion atipica') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Duglución atípica
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="respiracion bucal"
                                                    {{ $antPersonales?->retornar_habitos('respiracion bucal') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Respiración bucal
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id=""
                                                        name="habitos[]" value="bruxismo"
                                                        {{ $antPersonales?->retornar_habitos('bruxismo') == true ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="">
                                                        Bruxismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="succion digital"
                                                    {{ $antPersonales?->retornar_habitos('succion digital') == true ? 'checked' : '' }}>
                                                <label class="form-check-label" for="">
                                                    Succión Digital
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="otro_habito"
                                                        id="" aria-describedby="helpId" placeholder="Otro"
                                                        value="{{ $antPersonales?->otro_habito }}">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                                    Actualizar Historia Clínica</button>
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

            // Controlar la visibilidad del input semanas de embarazo según la respuesta de embarazada
            $('input[name="embarazada"]').on('change', function() {
                const embarazada = $(this).val();
                if (embarazada === '0') {
                    $('#embarazada input').show();
                } else {
                    $('#embarazada input').hide();
                }
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
