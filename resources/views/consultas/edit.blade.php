@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form action="{{ route('consultas.update', $paciente->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card border">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <hr>
                    <h3 class="text-center g-2 fw-bold">Consultas</h3>
                    <hr>
                    <p class="text-center fs-5"><strong>Paciente: </strong>{{$paciente->nombres . ' ' . $paciente->apellidos}}</p>

                    {{-- @include('hclinicas.components.datos_personales', ['modo' => 'create']) --}}

                    @include('hclinicas.components.motivo_consulta', ['modo' => 'edit'])

                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'edit'])

                    {{-- @include('hclinicas.components.antecedentes_personales', ['modo' => 'create']) --}}

                    @include('hclinicas.components.antecedentes_patologicos', ['modo' => 'edit'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'edit'])

                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'edit'])

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                            Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
