@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header fw-bold">{{ __('Registrar Nuevo Usuario') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for=""
                                    class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Tipo de usuario') }}</label>
                                <div class="col-md-6">
                                    <select name="role" class="form-select form-select-md" id="roles"
                                        value="{{ old('role') }}" autofocus required>
                                        <option value="">Seleccione un tipo de usuario</option>
                                        <option value="admin">Administrador</option>
                                        <option value="odontologo">Odontólogo</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for=""
                                            class="form-label fw-bold">{{ __('Nombre de Usuario') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name"
                                            placeholder="Ejemplo: Odontologo Admin">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for=""
                                            class="form-label fw-bold">{{ __('Correo electrónico') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Ejemplo: admin@gmail.com">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label fw-bold">{{ __('Contraseña') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password"
                                            placeholder="Contraseña (mínimo 8 caracteres)">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for=""
                                            class="form-label fw-bold">{{ __('Confirmar contraseña') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Repita la misma contraseña">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <!-- datos odontologo -->
                            <div id="datos_odontologo" style="display:none">
                                <h5 class="card-title fw-bold">{{ __('Información del odontólogo') }}</h5>
                                <hr>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-bold">{{ __('Nombres') }}</label>
                                            <input type="text"class="form-control form-control-md" name="nombres"
                                                id="" aria-describedby="helpId" placeholder="Escriba sus nombres"
                                                value="{{ old('nombres') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-bold">{{ __('Apellidos') }}</label>
                                            <input type="text" class="form-control form-control-md" name="apellidos"
                                                id="" aria-describedby="helpId" placeholder="Escriba sus apellidos"
                                                value="{{ old('apellidos') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label fw-bold">Tipo de nacionalidad <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-select-md" name="tipo_nacionalidad_id" id="">
                                            <option value="">Seleccione el tipo de nacionalidad</option>
                                            @foreach ($tipos_nacionalidad as $tipo_nacionalidad)
                                                <option value="{{ $tipo_nacionalidad->id }}"
                                                    {{ old('tipo_nacionalidad_id') == $tipo_nacionalidad->id ? 'selected' : '' }}>
                                                    {{ strtoupper($tipo_nacionalidad->nombre) }}</option>
                                            @endforeach
                                        </select>
                
                                        @error('tipo_nacionalidad_id')
                                            <small class="text-danger"> {{ $message }}</small>
                                        @enderror
                
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label fw-bold">Tipo de documento de identificación <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-select-md" name="tipo_documento_id" id="">
                                            <option selected value="">Seleccione el tipo de documento de identificación</option>
                                            @foreach ($tipos_documento as $tipo_documento)
                                                <option value="{{ $tipo_documento->id }}"
                                                    {{ old('tipo_documento_id') == $tipo_documento->id ? 'selected' : '' }}>
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

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for=""
                                                class="form-label fw-bold">{{ __('Número de Registro') }}</label>
                                            <input type="text"class="form-control form-control-md" name="cedula"
                                                id="cedula_odo" aria-describedby="helpId"
                                                placeholder="Escriba su número de registro del ACESS" maxlength="16"
                                                value="{{ old('cedula') }}">
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-bold">{{ __('Celular') }}</label>
                                            <input type="text" class="form-control form-control-md" name="celular"
                                                id="celu" minlength="10" maxlength="10"
                                                value="{{ old('celular') }}" aria-describedby="helpId"
                                                placeholder="Escriba su celular">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-bold">{{ __('Género') }}</label>
                                            <select class="form-select form-select-md" name="sexo"
                                                aria-label=".form-select-sm example">
                                                <option>Seleccione el género</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Especialidades --}}
                                <div class="row">
                                    <label for=""
                                        class="form-label fw-bold">{{ __('Especialidades') }}</label>
                                    @foreach ($especialidades as $especialidad)
                                        <div class="col-lg-5 col-md-5 col-sm-6">
                                            <input class="form-check-input border-primary" type="checkbox"
                                                id="check_especialidades{{ $especialidad->id }}" name="especialidades[]"
                                                value="{{ $especialidad->id }}">
                                            <label class="form-check-label"
                                                for="check_especialidades{{ $especialidad->id }}">
                                                {{ $especialidad->nombre }}
                                            </label>

                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <!--Registrar Button -->

                            <div class="row mb-0 text-end">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#roles').change(function() {
                var selectedOptionText = $(this).find(':selected').text();
                if (selectedOptionText.includes('Odontólogo')) {
                    $('#datos_odontologo').show();
                    setRequieredOdontologoInputs();
                } else
                    $('#datos_odontologo').hide();
            });
        });

        /* function setRequieredOdontologoInputs() {
            const inputs = document.querySelectorAll('#datos_odontologo input');
            inputs.forEach(input => {
                input.required = true;
            });
        } */
    </script>
@endsection
