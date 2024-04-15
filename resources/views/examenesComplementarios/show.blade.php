@extends('layouts.app')
@section('content')
    <x-navegacion-hClinica :hClinica="$hClinica" />
    <hr>
    <h4 class="fw-bold text-center mt-4">Exámenes Complementarios</h4>
    <hr>
    <h4 class="text-center"><strong>Paciente: </strong>{{$hClinica->paciente->nombreCompleto()}}</h4>

    <div class="d-flex justify-content-end">
        <a class="btn btn-primary text-white" href="{{ route('examenesComplementarios.edit', $hClinica->id) }}">Editar</a>
    </div>
    @include('hclinicas.components.exanenes_complementarios', ['modo' => 'show'])
@endsection
