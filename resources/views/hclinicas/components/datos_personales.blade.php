<!--Datos Generales-->
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="card text-start">
            <div class="card-body">
                <h5 class="card-title fw-bolder">A. Datos del Paciente</h5>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">

                        <label for="nombres" class="form-label fw-bold">Nombres <span class="text-danger">*</span></label>
                        <input type="text"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->nombres : old('nombres') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" name="nombres" id=""
                            aria-describedby="helpId" placeholder="Escriba los nombres del paciente" required autofocus>

                        @error('nombres')
                            <small class="text-danger"> {{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-6">

                        <label for="" class="form-label fw-bold">Apellidos <span
                                class="text-danger">*</span></label>
                        <input type="text"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->apellidos : old('apellidos') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" name="apellidos" id=""
                            aria-describedby="helpId" placeholder="Escriba los apellidos del paciente" required>
                        @error('apellidos')
                            <small class="text-danger"> {{ $message }}</small>
                        @enderror

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="" class="form-label fw-bold">Tipo de nacionalidad <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="tipo_nacionalidad_id" id="" required
                            {{ $modo == 'show' ? 'disabled' : '' }}>
                            <option value="">Seleccione el tipo de nacionalidad</option>
                            @foreach ($tipos_nacionalidad as $tipo_nacionalidad)
                                <option value="{{ $tipo_nacionalidad->id }}"
                                    {{ ($modo == 'show' || $modo == 'edit') && $paciente->tipo_nacionalidad_id == $tipo_nacionalidad->id ? 'selected' : '' }}>
                                    {{ $tipo_nacionalidad->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('tipo_nacionalidad_id')
                            <small class="text-danger"> {{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label fw-bold">Tipo de documento de identificación <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-md" name="tipo_documento_id" id="" required
                            {{ $modo == 'show' ? 'disabled' : '' }}>
                            <option selected value="">Seleccione el tipo de documento de identificación</option>
                            @foreach ($tipos_documento as $tipo_documento)
                                <option value="{{ $tipo_documento->id }}"
                                    {{ ($modo == 'show' || $modo == 'edit') && $paciente->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>
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
                            <label for="" class="form-label fw-bold">Nro del documento de identificación</label>
                            <input type="text" class="form-control" name="cedula"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->cedula : old('cedula') }}"
                                {{ $modo == 'show' ? 'readonly' : '' }} minlength="10" maxlength="16" id="cedula"
                                aria-describedby="helpId" placeholder="Escriba el nro de identificación del paciente">
                            @error('cedula')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Fecha de Nacimiento <span
                                    class="text-danger">*</span></label>
                            <input type="date"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->fecha_nacimiento : old('fecha_nacimiento') }}"
                                {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" name="fecha_nacimiento"
                                id="fecha_nacimiento" max="<?php echo date('Y-m-d'); ?>" id="fechaNacimiento"
                                placeholder="dd/mm/aaaa" pattern="\d{2}/\d{2}/\d{4}" required>

                            @error('fecha_nacimiento')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Edad</label>
                            <input type="text"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->edad : old('edad') }}"
                                {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" name="edad"
                                id="edad" aria-describedby="helpId" placeholder="" readonly min="0"
                                max="120" required>

                            @error('edad')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row" id="representanteDiv" style="display: none;">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Cédula del
                                    Representante <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('cedula_representante') }}"
                                    {{ $modo == 'show' ? 'readonly' : '' }} name="cedula_representante"
                                    minlength="10" maxlength="10" id="" aria-describedby="helpId"
                                    placeholder="Escriba la cédula del representante" pattern="^[0-9]+$">

                                @error('cedula_representante')
                                    <small class="text-danger"> {{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Representante <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('representante') }}"
                                    {{ $modo == 'show' ? 'readonly' : '' }} name="representante" id="representante"
                                    aria-describedby="helpId" placeholder="Nombre del representante">

                                @error('representante')
                                    <small class="text-danger"> {{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label for="" class="form-label fw-bold">Estado civil <span
                                class="text-danger">*</span></label>
                        <select name="estado_civil" id="" class="form-select form-select-md" required {{ $modo == 'show' ? 'disabled' : '' }}>
                            <option selected value="">Seleccione el estado civil del paciente
                            </option>
                            <option value="soltero"
                                {{ ($modo == 'show' || $modo == 'edit') && $paciente->estado_civil == 'soltero' ? 'selected' : '' }}>
                                Soltero/a</option>
                            <option value="casado"
                                {{ ($modo == 'show' || $modo == 'edit') && $paciente->estado_civil == 'casado' ? 'selected' : '' }}>
                                Casado/a
                            </option>
                            <option value="unionlibre"
                                {{ ($modo == 'show' || $modo == 'edit') && $paciente->estado_civil == 'unionlibre' ? 'selected' : '' }}>
                                Unión
                                Libre</option>
                            <option value="divorciado"
                                {{ ($modo == 'show' || $modo == 'edit') && $paciente->estado_civil == 'divorciado' ? 'selected' : '' }}>
                                Divorciado/a</option>
                            <option value="viudo"
                                {{ ($modo == 'show' || $modo == 'edit') && $paciente->estado_civil == 'viudo' ? 'selected' : '' }}>
                                Viudo/a
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
                            <select class="form-select form-select-md" name="sexo" required {{ $modo == 'show' ? 'disabled' : '' }}
                                aria-label=".form-select-sm example">
                                <option selected value="">Seleccione el género del paciente
                                </option>
                                <option value="masculino"
                                    {{ ($modo == 'show' || $modo == 'edit') && $paciente->sexo == 'masculino' ? 'selected' : '' }}>
                                    Masculino</option>
                                <option value="femenino"
                                    {{ ($modo == 'show' || $modo == 'edit') && $paciente->sexo == 'femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>
                                <option value="otro"
                                    {{ ($modo == 'show' || $modo == 'edit') && $paciente->sexo == 'otro' ? 'selected' : '' }}>
                                    Otro
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
                            <input type="text"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->celular : old('celular') }}" {{ $modo == 'show' ? 'readonly' : '' }}
                                class="form-control" name="celular" minlength="10" maxlength="10" id="celular"
                                aria-describedby="helpId" placeholder="Escirba el celular del paciente"
                                pattern="^[0-9]+$">

                            @error('celular')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Teléfono
                                Convencional</label>
                            <input type="text"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->telef_convencional : old('telef_convencional') }}" {{ $modo == 'show' ? 'readonly' : '' }}
                                id="telefono" class="form-control" name="telef_convencional" id=""
                                aria-describedby="helpId" minlength="6" maxlength="9" pattern="^[0-9]+$"
                                placeholder="Por ejemplo: 2831373">

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
                                (Ciudad/Barrio) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="direccion" id=""
                                aria-describedby="helpId" placeholder="Escriba dónde reside el paciente"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->direccion : old('direccion') }}" {{ $modo == 'show' ? 'readonly' : '' }}
                                required>
                            @error('direccion')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Profesión u
                                Ocupación <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ocupacion" id=""
                                aria-describedby="helpId" placeholder="Escriba la ocupación del paciente"
                                value="{{ $modo == 'show' || $modo == 'edit' ? $paciente->ocupacion : old('ocupacion') }}" {{ $modo == 'show' ? 'readonly' : '' }}
                                required>
                            @error('ocupacion')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Fin Datos Generales-->
