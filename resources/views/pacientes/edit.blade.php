@extends('layouts.app')
@section('content')
    <x-navegacion-hClinica :hClinica="$hClinica" />
    <form method="post" action="{{ route('pacientes.update', $paciente->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="consentimiento" value="{{ $paciente->consentimiento }}">

        @include('hclinicas.components.datos_personales', ['modo' => 'edit'])

        <!--Boton Guardar-->
        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                Guardar</button>
        </div>
        <!--Fin Boton Guardar-->


    </form>

    {{-- <script src="{{ asset('assets/js/controles_hclinica.js') }}"></script> --}}
@endsection
