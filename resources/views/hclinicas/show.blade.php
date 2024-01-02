@extends('layouts.app')
@section('content')

{{-- <x-container-info-pacientes-navegacion :paciente="$paciente" :antecedentes="$antPersonales?"></x-container-info-pacientes-navegacion> --}}

<x-navegacion-paciente :paciente="$paciente" />
    <form>
        <div class="card">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center fw-bold g-2">Historia Clínica Odontológica</h3>

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
                                                    value="{{ $paciente->nombres }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos" id=""
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->apellidos }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Cédula</label>
                                                <input type="text" class="form-control" name="cedula" minlength="10"
                                                    maxlength="10" id="cedula" aria-describedby="helpId" placeholder=""
                                                    required value="{{ $paciente->cedula }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Fecha de Nacimiento</label>
                                                <input type="date" id="fecha_nacimiento"
                                                    value="{{ $paciente->fecha_nacimiento }}" class="form-control"
                                                    max="<?php echo date('Y-m-d'); ?>" name="fecha_nacimiento" id="fechaNacimiento"
                                                    placeholder="dd-mm-aaaa" pattern="\d{4}-\d{2}-\d{2}" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Edad</label>
                                                <input type="text" class="form-control" name="edad" id="edad"
                                                    aria-describedby="helpId" placeholder="" readonly
                                                    value="{{ $paciente->edad }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    @if ( ($paciente->edad < 12) && ($representante != null) )
                                        <div class="row" id="representanteDiv">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Cédula del
                                                        Representante</label>
                                                    <input type="text" class="form-control" name="cedula_representante"
                                                        minlength="10" maxlength="10" id=""
                                                        aria-describedby="helpId" placeholder="" pattern="^[0-9]+$"
                                                        value="{{ $representante->cedula_representante }}" readonly>

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
                                                        aria-describedby="helpId" placeholder="Nombre del representante"
                                                        readonly>

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
                                                required disabled>

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
                                                    disabled aria-label=".form-select-md example">
                                                    <option value="masculino"
                                                        {{ $paciente->sexo === 'masculino' ? 'selected' : '' }}>
                                                        Masculino</option>
                                                    <option value="femenino"
                                                        {{ $paciente->sexo === 'femenino' ? 'selected' : '' }}>
                                                        Femenino</option>
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
                                                    value="{{ $paciente->celular }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Teléfono
                                                    Convencional</label>
                                                <input type="text" class="form-control" name="telef_convencional"
                                                    id="telefono" aria-describedby="helpId" maxlength="9" readonly
                                                    placeholder="" value="{{ $paciente->telef_convencional }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Direción</label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->direccion }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Profesión u
                                                    Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->ocupacion }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


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
                                                {{ $antPersonales?->retornar_enfermedades('hipertension') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Hipertensión
                                            </label>

                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="enfermedades cardiacas"
                                                {{ $antPersonales?->retornar_enfermedades('enfermedades cardiacas') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Enfermedades Cardiacas
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="diabetes mellitus"
                                                {{ $antPersonales?->retornar_enfermedades('diabetes mellitus') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Diabetes Mellitus
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hepatitis"
                                                {{ $antPersonales?->retornar_enfermedades('hepatitis') == true ? 'checked' : '' }}
                                                readonly>
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
                                                    {{ $antPersonales?->retornar_enfermedades('fiebre reumatica') == true ? 'checked' : '' }}
                                                    readonly>
                                                <label class="form-check-label" for="">
                                                    Fiebre Reumática
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="tuberculosis"
                                                {{ $antPersonales?->retornar_enfermedades('tuberculosis') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Tuberculosis
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="asma"
                                                {{ $antPersonales?->retornar_enfermedades('asma') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Asma
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hemorragias"
                                                {{ $antPersonales?->retornar_enfermedades('hemorragias') == true ? 'checked' : '' }}
                                                readonly>
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
                                                    {{ $antPersonales?->retornar_enfermedades('epilepsias') == true ? 'checked' : '' }}
                                                    readonly>
                                                <label class="form-check-label" for="">
                                                    Epilepsias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="alergias"
                                                {{ $antPersonales?->retornar_enfermedades('alergias') == true ? 'checked' : '' }}
                                                readonly>
                                            <label class="form-check-label" for="">
                                                Alergias
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="otra_enfermedad"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales?->otra_enfermedad }}"
                                                    placeholder="Otra Enfermedad" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="parentesco"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales?->parentesco }}" placeholder="Parentesco"
                                                    readonly>
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
                                                    <input class="form-check-input" type="radio" id=""
                                                        name="embarazada" value="0"
                                                        {{ $antPersonales?->embarazada == '0' ? 'checked' : '' }}
                                                        disabled>
                                                    <label readonly="form-check-label" for="">
                                                        Sí
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-5">
                                            <div class="col-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id=""
                                                        name="embarazada" value="1"
                                                        {{ $antPersonales?->embarazada == '1' ? 'checked' : '' }}
                                                        readonly>
                                                    <label class="form-check-label" for="">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <div class="mb-3">
                                                <input type="number" class="form-control" name="semanas_embarazo"
                                                    id="" aria-describedby="helpId"
                                                    placeholder="Semanas de Embarazo"
                                                    value="{{ $antPersonales?->semanas_embarazo }}" readonly>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Toma algún
                                                        medicamento?</label>
                                                    <input type="text" class="form-control" name="medicamento"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        value="{{ $antPersonales?->medicamento }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">¿Algún otro
                                                        antecedente?</label>
                                                    <input type="text" class="form-control" name="otro_antecedente"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        value="{{ $antPersonales?->otro_antecendente }}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <h6 class="fw-bold">HÁBITOS (Seleccione los hábitos del paciente)</h6>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id=""
                                                        name="habitos[]" value="tabaquismo"
                                                        {{ $antPersonales?->retornar_habitos('tabaquismo') == true ? 'checked' : '' }}
                                                        readonly>
                                                    <label class="form-check-label" for="">
                                                        Tabaquismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="alcohol"
                                                    {{ $antPersonales?->retornar_habitos('alcohol') == true ? 'checked' : '' }}
                                                    readonly>
                                                <label class="form-check-label" for="">
                                                    Alcohol
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="duglucion atipica"
                                                    {{ $antPersonales?->retornar_habitos('duglucion atipica') == true ? 'checked' : '' }}
                                                    readonly>
                                                <label class="form-check-label" for="">
                                                    Duglución atípica
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="respiracion bucal"
                                                    {{ $antPersonales?->retornar_habitos('respiracion bucal') == true ? 'checked' : '' }}
                                                    readonly>
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
                                                        {{ $antPersonales?->retornar_habitos('bruxismo') == true ? 'checked' : '' }}
                                                        readonly>
                                                    <label class="form-check-label" for="">
                                                        Bruxismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="succion digital"
                                                    {{ $antPersonales?->retornar_habitos('succion digital') == true ? 'checked' : '' }}
                                                    readonly>
                                                <label class="form-check-label" for="">
                                                    Succión Digital
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="otro_habito"
                                                        id="" aria-describedby="helpId" placeholder="Escriba otro hábito"
                                                        value="{{ $antPersonales?->otro_habito }}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
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
