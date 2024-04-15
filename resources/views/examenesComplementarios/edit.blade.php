@extends('layouts.app')
@section('content')
    <x-navegacion-hClinica :hClinica="$hClinica" />
    <hr>
    <h4 class="fw-bold text-center mt-4">Exámenes Complementarios</h4>
    <hr>
    <h4 class="text-center"><strong>Paciente: </strong>{{$hClinica->paciente->nombreCompleto()}}</h4>
    <form action="{{ route('examenesComplementarios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="hclinica_id" value="{{$hClinica->id}}">
        @include('hclinicas.components.examenes_complementarios', ['modo' => 'edit'])
        <div class="text-end">
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                Guardar</button>
        </div>
    </form>
@endsection
