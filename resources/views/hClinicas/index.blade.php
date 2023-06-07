@extends('layouts.app')
@section('content')

<a href="{{ route('hclinicas.create') }}" class="btn btn-primary">Nuevo historia clínica</a>


<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Celular</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr class="">
                <td scope="row">{{$paciente->id}}</td>
                <td>{{$paciente->cedula}}</td>
                <td>{{$paciente->nombres}}</td>
                <td>{{$paciente->apellidos}}</td>
                <td>{{$paciente->celular}}</td>
                <td>
                    
                    <!--editar-->
                    <a href="{{ route('hclinicas.edit', $paciente->id) }}" class="btn btn-success">Editar</a>

                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">
                        Eliminar
                    </button>

                </td>
            </tr>
            @include('hClinicas.destroy')
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection


