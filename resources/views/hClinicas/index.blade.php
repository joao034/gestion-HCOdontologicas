@extends('layouts.app')
@section('content')

<a href="{{ route('hclinicas.create') }}" class="btn btn-primary">Nuevo historia clínica</a>


<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Fec. Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr class="">
                <td scope="row">{{$paciente->cedula}}</td>
                <td>{{$paciente->nombres}}</td>
                <td>{{$paciente->apellidos}}</td>
                <td>{{$paciente->fecha_nacimiento}}</td>
                <td>
                    
                    <!--editar-->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$paciente->id}}">
                        Editar
                    </button>
                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">
                        Eliminar
                    </button>

                </td>
            </tr>
            {{-- @include('pacientes.info') --}}
            @endforeach

        </tbody>
    </table>
</div>

@endsection


