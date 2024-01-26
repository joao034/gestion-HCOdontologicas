@extends('layouts.app')
@section('content')

    @if (!request()->ajax())
        <h3 class="text-center fw-bold">Pacientes por odontólogo</h3>
        <hr>
        <form action="{{route('asignar.odontologo')}}" id="odontologoForm" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-5">
                    <label for="odontologo_id_origen" class="form-label fw-bold">{{ __('Odontólogo') }}</label>
                    <select class="form-select form-select-md" name="odontologo_id_origen" required
                        aria-label=".form-select-md example" id="odontologo_id_origen" autofocus>
                        <option value="0">Seleccione un odontólogo</option>
                        @foreach ($odontologos as $odontologo)
                            <option value="{{ $odontologo->id }}">
                                {{ $odontologo->nombres . ' ' . $odontologo->apellidos . '  - ' . $odontologo->get_nombres_especialidades() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--Odontologo a asignar-->
                <div class="col-md-5">
                    <label for="odontologo_id_destino" class="form-label fw-bold">{{ __('Odontólogo a asignar pacientes') }}</label>
                    <select class="form-select form-select-md" name="odontologo_id_destino" required
                        aria-label=".form-select-md example" id="odontologo_id_destino" autofocus>
                        <option value="0">Seleccione un odontólogo</option>
                        @foreach ($odontologos as $odontologo)
                            <option value="{{ $odontologo->id }}">
                                {{ $odontologo->nombres . ' ' . $odontologo->apellidos . '  - ' . $odontologo->get_nombres_especialidades() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-pen-to-square"></i> Asignar</button>
                </div>

                {{-- <p class="fw-bold">Seleccione un rango de fechas:</p>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Fecha de inicio</label>
                    <input type="date" value="{{ old('fecha_inicio') }}" class="form-control" name="fecha_inicio"
                        id="fecha_inicio" max="<?php echo date('Y-m-d'); ?>" placeholder="dd/mm/aaaa" pattern="\d{2}/\d{2}/\d{4}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Fecha de fin</label>
                    <input type="date" value="{{ old('fecha_fin') }}" class="form-control" name="fecha_inicio"
                        id="fecha_fin" max="<?php echo date('Y-m-d'); ?>" placeholder="dd/mm/aaaa" pattern="\d{2}/\d{2}/\d{4}"
                        required>
                </div> --}}

            </div>
            <a type="button" class="my-3 btn btn-danger" id="generatePdfBtn" target="_blank">
                <i class="fa-solid fa-file-pdf"></i> Descargar PDF
            </a>
        </form>
    @endif

    @include('reportes.pacientes-por-odontologo.table', ['pacientes' => $pacientes])

    @if (!request()->ajax())
        <script src="{{ asset('assets/js/pacientes-por-odontologo.js') }}"></script>
    @endif

@endsection


