@extends('layouts.app')
@section('content')

<h1 class="text-center">Odontólogos</h1>

<!-- Agregar tratamiento -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
    Nuevo Odontólogo
</button>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Celular</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($odontologos as $odontologo)
            <tr class="">
                <td scope="row">{{$odontologo->cedula}}</td>
                <td>{{$odontologo->nombres}}</td>
                <td>{{$odontologo->apellidos}}</td>
                <td>{{$odontologo->especialidad->nombre}}</td>
                <td>{{$odontologo->celular}}</td>
                <td>
                    <!--editar-->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$odontologo->id}}">
                        Editar
                    </button>

                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$odontologo->id}}">
                        Eliminar
                    </button>

                </td>
            </tr>
            @include('odontologos.info')
            @endforeach
        </tbody>
    </table>
</div>
@include('odontologos.create')
@endsection