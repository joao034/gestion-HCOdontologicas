@extends('layouts.app')
@section('content')

<h1 class="text-center">Especialidades</h1>

<!-- Agregar tratamiento -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
    Nueva Especialidad
</button>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
            <tr class="">
                <td scope="row">{{$especialidad->id}}</td>
                <td>{{$especialidad->nombre}}</td>
                <td>{{$especialidad->descripcion}}</td>
                <td>
                    <!--editar-->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$especialidad->id}}">
                        Editar
                    </button>

                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$especialidad->id}}">
                        Eliminar
                    </button>

                </td>
            </tr>
            @include('especialidades.info')
            @endforeach
        </tbody>
    </table>
</div>
@include('especialidades.create')
@endsection