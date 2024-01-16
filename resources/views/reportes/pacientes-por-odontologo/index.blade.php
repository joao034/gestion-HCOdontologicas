@extends('layouts.app')
@section('content')

    @if (!request()->ajax())
        <h3 class="text-center fw-bold">Pacientes por odontólogo</h3>
        <hr>
        <form action="" id="odontologoForm" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="odontologo_id" class="form-label fw-bold">{{ __('Odontólogo') }}</label>
                    <select class="form-select form-select-md" name="odontologo_id" required
                        aria-label=".form-select-md example" id="odontologo_id" autofocus>
                        <option value="0">Seleccione un odontólogo</option>
                        @foreach ($odontologos as $odontologo)
                            <option value="{{ $odontologo->id }}">
                                {{ $odontologo->nombres . ' ' . $odontologo->apellidos . '  - ' . $odontologo->especialidad->nombre }}
                            </option>
                        @endforeach
                    </select>
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
            <a type="button" class="mt-3 btn btn-danger" target="_blank" id="generatePdfBtn">
                <i class="fa-solid fa-file-pdf"></i> Descargar PDF
            </a>
        </form>
    @endif

    @include('reportes.pacientes-por-odontologo.table', ['pacientes' => $pacientes])

    @if (!request()->ajax())
        <script src="{{ asset('assets/js/pacientes-por-odontologo.js') }}"></script>
    @endif

@endsection
