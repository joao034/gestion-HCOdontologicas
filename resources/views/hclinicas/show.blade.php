@extends('layouts.app')
@section('content')

    <x-info-paciente :paciente="$paciente" :antecedentes="$antPersonales"/>
    <x-navegacion-paciente :paciente="$paciente" />

    <form>
        <div class="card border-primary">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h2 class="text-center g-2">Historia Clínica Odontológica</h2>

                    <!--Datos Generales-->
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-10">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Datos Personales</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Nombres</label>
                                                <input type="text" class="form-control" name="nombres" id=""
                                                    aria-describedby="helpId" placeholder="" required
                                                    value="{{ $paciente->nombres }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos" id=""
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->apellidos }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Cédula</label>
                                                <input type="text" class="form-control" name="cedula" minlength="10"
                                                    maxlength="10" id="cedula" aria-describedby="helpId" placeholder=""
                                                    required value="{{ $paciente->cedula }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" id="fecha_nacimiento"
                                                    value="{{ $paciente->fecha_nacimiento }}" class="form-control"
                                                    max="<?php echo date('Y-m-d'); ?>" name="fecha_nacimiento" id="fechaNacimiento"
                                                    placeholder="dd-mm-aaaa" pattern="\d{4}-\d{2}-\d{2}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Edad</label>
                                                <input type="text" class="form-control" name="edad" id="edad"
                                                    aria-describedby="helpId" placeholder="" readonly
                                                    value="{{ $paciente->edad }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($paciente->edad < 12)
                                        <div class="row" id="representanteDiv">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Cédula del
                                                        Representante</label>
                                                    <input type="text" class="form-control" name="cedula_representante"
                                                        minlength="10" maxlength="10" id=""
                                                        aria-describedby="helpId" placeholder="" pattern="^[0-9]+$"
                                                        value="{{ $paciente->cedula_representante }}" disabled>

                                                    @error('cedula_representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Representante</label>
                                                    <input type="text" class="form-control" name="representante"
                                                        id="representante" value="{{ $paciente->representante }}"
                                                        aria-describedby="helpId" placeholder="Nombre del representante" disabled>

                                                    @error('representante')
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="card-title">Estado Civil</h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-check" id="form-check-estado-civil">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkSoltero" name="estado_civil" value="soltero"
                                                                    {{ $paciente->estado_civil == 'soltero' ? 'checked' : '' }}
                                                                    required disabled>
                                                                <label class="form-check-label"
                                                                    for="checkSoltero">Soltero/a </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkCasado" name="estado_civil" value="casado"
                                                                    {{ $paciente->estado_civil == 'casado' ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label"
                                                                    for="checkCasado">Casado/a</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkDivorciado" name="estado_civil"
                                                                    value="divorciado"
                                                                    {{ $paciente->estado_civil == 'divorciado' ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="checkDivorciado">
                                                                    Divorciado/a
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkViudo" name="estado_civil" value="viudo" disabled
                                                                    {{ $paciente->estado_civil == 'viudo' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="checkViudo">
                                                                    Viudo/a
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkUnionLibre" name="estado_civil"
                                                                    value="unionlibre" disabled
                                                                    {{ $paciente->estado_civil == 'unionlibre' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="checkUnionLibre">
                                                                    Unión Libre
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h6 class="card-title">Género</h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkMasculino" name="sexo" value="masculino"
                                                                    required disabled
                                                                    {{ $paciente->sexo == 'masculino' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="checkMasculino">
                                                                    Masculino
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    id="checkFemenino" name="sexo" value="femenino" disabled
                                                                    {{ $paciente->sexo == 'femenino' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="checkFemenino">
                                                                    Femenino
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Celular</label>
                                                <input type="text" class="form-control" name="celular" minlength="10"
                                                    id="celular" minlength="10" maxlength="10"
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->celular }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Teléfono Convencional</label>
                                                <input type="text" class="form-control" name="telef_convencional"
                                                    id="telefono" aria-describedby="helpId" maxlength="9" disabled
                                                    placeholder="" value="{{ $paciente->telef_convencional }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Direción</label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->direccion }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Prefesión u Oficio</label>
                                                <input type="text" class="form-control" name="ocupacion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->ocupacion }}" disabled >
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
                                    <p>¿USTED, SUS PADRES O ABUELOS PADECE O HA PADECIDO ALGUNA DE LAS SIGUIENTES
                                        ENFERMEDADES?</p>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hipertension"
                                                {{ $antPersonales->retornar_enfermedades('hipertension') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Hipertensión
                                            </label>

                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="enfermedades cardiacas"
                                                {{ $antPersonales->retornar_enfermedades('enfermedades cardiacas') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Enfermedades Cardiacas
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="diabetes mellitus"
                                                {{ $antPersonales->retornar_enfermedades('diabetes mellitus') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Diabetes Mellitus
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hepatitis"
                                                {{ $antPersonales->retornar_enfermedades('hepatitis') == true ? 'checked' : '' }} disabled>
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
                                                    {{ $antPersonales->retornar_enfermedades('fiebre reumatica') == true ? 'checked' : '' }} disabled> 
                                                <label class="form-check-label" for="">
                                                    Fiebre Reumática
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="tuberculosis"
                                                {{ $antPersonales->retornar_enfermedades('tuberculosis') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Tuberculosis
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="asma"
                                                {{ $antPersonales->retornar_enfermedades('asma') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Asma
                                            </label>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="hemorragias"
                                                {{ $antPersonales->retornar_enfermedades('hemorragias') == true ? 'checked' : '' }} disabled>
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
                                                    {{ $antPersonales->retornar_enfermedades('epilepsias') == true ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="">
                                                    Epilepsias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <input class="form-check-input" type="checkbox" id=""
                                                name="enfermedades[]" value="alergias"
                                                {{ $antPersonales->retornar_enfermedades('alergias') == true ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="">
                                                Alergias
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="otra_enfermedad"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales->otra_enfermedad }}"
                                                    placeholder="Otra Enfermedad" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="parentesco"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $antPersonales->parentesco }}" placeholder="Parentesco" disabled>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-3 col-md-4">
                                            <p>¿Está Ud embarazada?</p>
                                        </div>
                                        <div class="col-1">
                                            <div class="col-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id=""
                                                        name="embarazada" value="0"
                                                        {{ $antPersonales['embarazada'] == '0' ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="">
                                                        Sí
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="col-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id=""
                                                        name="embarazada" value="1"
                                                        {{ $antPersonales['embarazada'] == '1' ? 'checked' : '' }} disabled>
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
                                                    value="{{ $antPersonales->semanas_embarazo }}" disabled>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">¿Toma algún
                                                        medicamento?</label>
                                                    <input type="text" class="form-control" name="medicamento"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        value="{{ $antPersonales->medicamento }}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">¿Algún otro
                                                        antecedente?</label>
                                                    <input type="text" class="form-control" name="otro_antecedente"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        value="{{ $antPersonales->otro_antecendente }}" disabled>
                                                </div>
                                            </div>
                                        </div>


                                        <p>HÁBITOS</p>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id=""
                                                        name="habitos[]" value="tabaquismo"
                                                        {{ $antPersonales->retornar_habitos('tabaquismo') == true ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="">
                                                        Tabaquismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="alcohol"
                                                    {{ $antPersonales->retornar_habitos('alcohol') == true ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="">
                                                    Alcohol
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="duglucion atipica"
                                                    {{ $antPersonales->retornar_habitos('duglucion atipica') == true ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="">
                                                    Duglución atípica
                                                </label>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="respiracion bucal"
                                                    {{ $antPersonales->retornar_habitos('respiracion bucal') == true ? 'checked' : '' }} disabled>
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
                                                        {{ $antPersonales->retornar_habitos('bruxismo') == true ? 'checked' : '' }} disabled>
                                                    <label class="form-check-label" for="">
                                                        Bruxismo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <input class="form-check-input" type="checkbox" id=""
                                                    name="habitos[]" value="succion digital"
                                                    {{ $antPersonales->retornar_habitos('succion digital') == true ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="">
                                                    Succión Digital
                                                </label>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="otro_habito"
                                                        id="" aria-describedby="helpId" placeholder="Otro"
                                                        value="{{ $antPersonales->otro_habito }}" disabled>
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
