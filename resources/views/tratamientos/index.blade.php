@extends('layouts.app')
@section('content')

<h1 class="text-center"> <img class="svg-icon-index" src="assets/icons/tratamiento.svg" alt=""> Tratamientos</h1>

<!-- Agregar tratamiento -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
    <i class="fa-solid fa-plus"></i> Nuevo tratamiento
</button>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Tratamiento</th>
                <th scope="col">Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tratamientos as $tratamiento)
            <tr class="">
                <td scope="row">{{$tratamiento->id}}</td>
                <td>{{$tratamiento->nombre}}</td>
                <td>$ {{$tratamiento->precio}}</td>
                <td>
                    <!--editar-->
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$tratamiento->id}}">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                    </button>

                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$tratamiento->id}}">
                        <i class="fa-regular fa-trash-can"></i> Eliminar
                    </button>

                </td>
            </tr>
            @include('tratamientos.info')
            @endforeach
        </tbody>
    </table>
</div>
@include('tratamientos.create')
@endsection