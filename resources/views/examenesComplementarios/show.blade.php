@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <h3 class="fw-bold text-center mt-4">Exámenes Complementarios de {{$paciente->nombres . ' ' . $paciente->apellidos}}</h3>

    <div class="d-flex justify-content-end">
        <a class="btn btn-primary text-white" href="{{ route('examenesComplementarios.edit', $paciente->id) }}">Editar</a>
    </div>
    @include('hclinicas.components.exanenes_complementarios', ['modo' => 'show'])
@endsection
