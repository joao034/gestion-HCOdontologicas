@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header fw-bold">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="" class="form-label fw-bold">Tipo de usuario</label>
                                    <select name="role" id="roles" class="form-select form-select-md" disabled>
                                        @if ($user->role == 'admin')
                                            <option value="admin" selected>Administrador</option>
                                            <option value="odontologo">Odontólogo</option>
                                        @endif
                                        @if ($user->role == 'odontologo')
                                            <option value="odontologo" selected>Odontólogo</option>
                                            <option value="admin">Administrador</option>
                                        @endif
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label fw-bold">Estado</label>
                                    <select name="active" class="form-select form-select-md">
                                        @if ($user->active == 1)
                                            <option value=1 selected>Activo</option>
                                            <option value=2>Inactivo</option>
                                        @endif
                                        @if ($user->active == 2)
                                            <option value=2 selected>Inactivo</option>
                                            <option value=1>Activo</option>
                                        @endif
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
                                            class="form-label fw-bold">{{ __('Nombre de usuario') }}</label>
                                        <input id="name" type="text" value="{{ $user->name }}"
                                            class="form-control @error('name') is-invalid 
                                    @enderror"
                                            name="name" value="{{ old('name') }}" required autocomplete="name">

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
                                        <input id="email" type="email" value="{{ $user->email }}"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Nueva Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password"
                                        placeholder="Ingrese la nueva contraseña">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <!-- Datos odontologo -->
                            @if ($user->role === 'odontologo')
                                <div id="datos_odontologo" style="display">
                                    <h5 class="card-title fw-bold">{{ __('Información del odontólogo') }}</h5>
                                    <hr>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for=""
                                                    class="form-label fw-bold">{{ __('Nombres') }}</label>
                                                <input type="text"class="form-control form-control" name="nombres"
                                                    id="" aria-describedby="helpId" placeholder=""
                                                    value="{{ $user->odontologo->nombres }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for=""
                                                    class="form-label fw-bold">{{ __('Apellidos') }}</label>
                                                <input type="text" class="form-control form-control" name="apellidos"
                                                    id="" aria-describedby="helpId"
                                                    value="{{ $user->odontologo->apellidos }}">
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
                                                        {{ $user->odontologo->tipo_nacionalidad_id == $tipo_nacionalidad->id ? 'selected' : '' }}>
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
                                                <option selected value="">Seleccione el tipo de
                                                    identificación</option>
                                                @foreach ($tipos_documento as $tipo_documento)
                                                    <option value="{{ $tipo_documento->id }}"
                                                        {{ $user->odontologo->tipo_documento_id == $tipo_documento->id ? 'selected' : '' }}>
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
                                                    class="form-label fw-bold">{{ __('Número de registro') }}</label>
                                                <input
                                                    type="text"class="form-control form-control @error('cedula') is-invalid @enderror"
                                                    name="cedula" id="cedula_odo" aria-describedby="helpId"
                                                    maxlength="16"
                                                    value="{{ $user->odontologo->cedula }}">
                                                @error('cedula')
                                                    <small class="text-danger"> {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for=""
                                                    class="form-label fw-bold">{{ __('Celular') }}</label>
                                                <input type="text" class="form-control form-control" name="celular"
                                                    id="celu" minlength="10" maxlength="10"
                                                    aria-describedby="helpId" value="{{ $user->odontologo->celular }}">
                                                @error('celular')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for=""
                                                    class="form-label fw-bold">{{ __('Género') }}</label>
                                                <select class="form-select form-select" name="sexo" required
                                                    aria-label=".form-select-sm example">
                                                    <option value="masculino"
                                                        {{ $user->odontologo['sexo'] == 'masculino' ? 'selected' : '' }}>
                                                        Masculino</option>
                                                    <option value="femenino"
                                                        {{ $user->odontologo['sexo'] == 'femenino' ? 'selected' : '' }}>
                                                        Femenino</option>
                                                    <option value="otro"
                                                        {{ $user->odontologo['sexo'] == 'otro' ? 'selected' : '' }}>Otro
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for=""
                                            class="form-label fw-bold">{{ __('Especialidades') }}</label>
                                        @foreach ($especialidades as $especialidad)
                                            <div class="col-lg-5 col-md-5 col-sm-6">
                                                <input class="form-check-input border-primary" type="checkbox"
                                                    id="check_especialidades{{ $especialidad->id }}"
                                                    name="especialidades[]" value="{{ $especialidad->id }}"
                                                    {{ in_array($especialidad->id, $user->odontologo->especialidades->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="check_especialidades{{ $especialidad->id }}">
                                                    {{ $especialidad->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif

                            <div class="row mb-0 text-end">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar Datos') }}
                                    </button>
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

        function setRequieredOdontologoInputs() {
            const inputs = document.querySelectorAll('#datos_odontologo input');
            inputs.forEach(input => {
                input.required = true;
            });
        }
    </script>
@endsection
