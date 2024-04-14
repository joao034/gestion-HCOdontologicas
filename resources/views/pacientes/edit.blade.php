@extends('layouts.app')
@section('content')
    <x-navegacion-hClinica :hClinica="$hClinica" />
    <form method="post" action="{{ route('pacientes.update', $paciente->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="consentimiento" value="{{ $paciente->consentimiento }}">

        @include('hclinicas.components.datos_personales', ['modo' => 'edit'])
        <!--Fin Datos Generales-->

        {{--  @include('hclinicas.components.motivo_consulta', ['modo' => 'edit'])
                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'edit']) --}}

        {{-- @include('hclinicas.components.antecedentes_personales', ['modo' => 'edit']) --}}
        {{-- @include('hclinicas.components.antecedentes_patologicos', ['modo' => 'edit'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'edit'])
                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'edit']) --}}


        {{-- @include('hclinicas.components.diagnostico', ['modo' => 'edit']) --}}


        <!--Boton Guardar-->
        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                Guardar</button>
        </div>
        <!--Fin Boton Guardar-->


    </form>

    <script src="{{ asset('assets/js/controles_hclinica.js') }}"></script>
@endsection
