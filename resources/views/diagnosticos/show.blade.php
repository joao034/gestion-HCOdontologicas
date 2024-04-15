@extends('layouts.app')
@section('content')
    <x-navegacion-hClinica :hClinica="$hClinica" />
    <hr>
    <h4 class="fw-bold text-center mt-4">N. Diagnóstico</h4>
    <hr>
    <h4 class="text-center"><strong>Paciente: </strong>{{ $hClinica->paciente->nombreCompleto() }}</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $hClinica->id }}">
        + Nuevo
    </button>

    {{-- <a class="btn btn-primary text-white" href="{{ route('diagnosticos.edit', $paciente->id) }}">+ Nuevo</a> --}}

    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'show']) --}}
    @include('diagnosticos.table', ['modo' => 'edit'])
    @include('diagnosticos.create')

    @include('profesional_responsable.edit', ['modo' => 'edit'])
@endsection
