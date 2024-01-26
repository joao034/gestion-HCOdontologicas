@extends('layouts.app')
@section('content')

    @if (!request()->ajax())
        <h3 class="text-center fw-bold">Pacientes por odontólogo</h3>
        <hr>
        <form action="{{ route('asignar.odontologo') }}" id="asignarPacientesForm" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-5">
                    <label for="odontologo_id_origen" class="form-label fw-bold">{{ __('Odontólogo') }}</label>
                    <select class="form-select form-select-md" name="odontologo_id_origen" required
                        aria-label=".form-select-md example" id="odontologo_id_origen" autofocus>
                        <option value="0">Seleccione el odontólogo</option>
                        @if (Auth::user()->role === 'admin')
                            @foreach ($odontologos as $odontologo)
                                <option value="{{ $odontologo->id }}">
                                    {{ $odontologo->nombres . ' ' . $odontologo->apellidos . '  - ' . $odontologo->get_nombres_especialidades() }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ Auth::user()->odontologo->id }}" >
                                {{ Auth::user()->odontologo->nombres . ' ' . Auth::user()->odontologo->apellidos . '  - ' . Auth::user()->odontologo->get_nombres_especialidades() }}
                            </option>
                        @endif
                    </select>
                </div>

                @if (Auth::user()->role == 'admin')
                    <!--Odontologo a asignar-->
                    <div class="col-md-5">
                        <label for="odontologo_id_destino"
                            class="form-label fw-bold">{{ __('Odontólogo a asignar pacientes') }}</label>
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
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#asignar"><i
                                class="fa-regular fa-pen-to-square"></i>
                            Asignar</button>
                    </div>
                @endif


            </div>
            <a type="button" class="my-3 btn btn-danger" id="generatePdfBtn" target="_blank">
                <i class="fa-solid fa-file-pdf"></i> Descargar PDF
            </a>
        </form>
    @endif

    <!--Modal-->
    <div class="modal" id="asignar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Asignar pacientes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    ¿Desea asignar los pacientes al odontólogo seleccionado?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Confirmar</button>
                </div>

            </div>
        </div>
    </div>


    @include('reportes.pacientes-por-odontologo.table', ['pacientes' => $pacientes])

    @if (!request()->ajax())
        <script src="{{ asset('assets/js/pacientes-por-odontologo.js') }}"></script>
    @endif

    <script>
        function submitForm() {
            document.getElementById('asignarPacientesForm').submit();
        }
    </script>

@endsection
