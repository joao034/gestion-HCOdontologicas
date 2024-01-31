@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <h3 class="fw-bold text-center mt-4">Diagnóstico</h3>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $paciente->id }}">
        + Nuevo
    </button>

    {{-- <a class="btn btn-primary text-white" href="{{ route('diagnosticos.edit', $paciente->id) }}">+ Nuevo</a> --}}

    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'show']) --}}
    @include('diagnosticos.table')
    @include('diagnosticos.create')
@endsection
