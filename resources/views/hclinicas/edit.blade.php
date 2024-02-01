@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form method="post" action="{{ route('hclinicas.update', $paciente->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="consentimiento" value="{{ $paciente->consentimiento }}">
        <div class="card">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center fw-bold">Historia Clínica Odontológica Editable</h3>

                    <!--Datos Generales-->
                    {{-- <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Datos Personales</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Nombres <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nombres" id=""
                                                    aria-describedby="helpId" placeholder="" required
                                                    value="{{ $paciente->nombres }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Apellidos <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="apellidos" id=""
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->apellidos }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="" class="form-label fw-bold">Tipo de nacionalidad <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select form-select-md" name="tipo_nacionalidad_id"
                                                id="">
                                                <option value="">Seleccione el tipo de nacionalidad</option>
                                                @foreach ($tipos_nacionalidad as $tipo_nacionalidad)
                                                    <option value="{{ $tipo_nacionalidad->id }}"
                                                        {{ $paciente->tipo_nacionalidad_id == $tipo_nacionalidad->id ? 'selected' : '' }}>
                                                        {{ $tipo_nacionalidad->nombre }}</option>
                                                @endforeach
                                            </select>

                                            @error('tipo_nacionalidad_id')
                                                <small class="text-danger"> {{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label fw-bold">Tipo de documento de
                                                identificación <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-md" name="tipo_documento_id"
                                                id="">
                                                <option selected value="">Seleccione el tipo de documento de
                                                    identificación</option>
                                                @foreach ($tipos_documento as $tipo_documento)
                                                    <option value="{{ $tipo_documento->id }}"
                                                        {{ $paciente->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>
                                                        {{ mb_strtoupper($tipo_documento->nombre) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('tipo_documento_id')
                                            <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Cédula</label>
                                                <input type="text" class="form-control" name="cedula" minlength="10"
                                                    maxlength="16" id="cedula" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->cedula }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Fecha de Nacimiento <span
                                                        class="text-danger">*</span></label>
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
                                                        Representante <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        name="cedula_representante" minlength="10" maxlength="10"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        pattern="^[0-9]+$"
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
                                            <label for="" class="form-label fw-bold">Estado civil <span
                                                    class="text-danger">*</span></label>
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
                                                <label for="" class="form-label fw-bold">Género <span
                                                        class="text-danger">*</span></label>
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
                                                <label for="" class="form-label fw-bold">Direción <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="direccion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->direccion }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Profesión u
                                                    Ocupación <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="ocupacion"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $paciente->ocupacion }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div> --}}
                    @include('hclinicas.components.datos_personales', ['modo' => 'edit'])
                    <!--Fin Datos Generales-->

                    @include('hclinicas.components.motivo_consulta', ['modo' => 'edit'])
                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'edit'])

                    {{-- @include('hclinicas.components.antecedentes_personales', ['modo' => 'edit']) --}}
                    @include('hclinicas.components.antecedentes_patologicos', ['modo' => 'edit'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'edit'])
                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'edit'])


                    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'edit']) --}}


                    <!--Boton Guardar-->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                            Actualizar Historia Clínica</button>
                    </div>
                    <!--Fin Boton Guardar-->

                </div>
    </form>

    <script src="{{ asset('assets/js/controles_hclinica.js') }}"></script>
@endsection
