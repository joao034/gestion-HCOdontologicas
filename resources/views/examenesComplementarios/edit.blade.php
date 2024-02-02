@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <h3 class="fw-bold text-center mt-4">Exámenes Complementarios de {{$paciente->nombres . ' ' . $paciente->apellidos}}</h3>
    <form action="{{ route('examenesComplementarios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="paciente_id" value="{{$paciente->id}}">
        @include('hclinicas.components.exanenes_complementarios', ['modo' => 'edit'])
        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                Guardar</button>
        </div>
    </form>
@endsection
