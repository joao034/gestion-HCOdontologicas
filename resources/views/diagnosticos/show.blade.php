@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <hr>
    <h3 class="fw-bold text-center mt-4">N. Diagnóstico</h3>
    <hr>
    <p class="fs-5 text-center"><strong>Paciente: </strong>{{$paciente->nombres . ' ' . $paciente->apellidos}}</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $paciente->id }}">
        + Nuevo
    </button>

    {{-- <a class="btn btn-primary text-white" href="{{ route('diagnosticos.edit', $paciente->id) }}">+ Nuevo</a> --}}

    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'show']) --}}
    @include('diagnosticos.table')
    @include('diagnosticos.create')
@endsection
