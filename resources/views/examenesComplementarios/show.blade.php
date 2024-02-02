@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <hr>
    <h3 class="fw-bold text-center mt-4">Exámenes Complementarios</h3>
    <hr>
    <p class="fs-5 text-center"><strong>Paciente: </strong>{{$paciente->nombres . ' ' . $paciente->apellidos}}</p>

    <div class="d-flex justify-content-end">
        <a class="btn btn-primary text-white" href="{{ route('examenesComplementarios.edit', $paciente->id) }}">Editar</a>
    </div>
    @include('hclinicas.components.exanenes_complementarios', ['modo' => 'show'])
@endsection
