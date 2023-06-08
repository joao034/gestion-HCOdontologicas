@extends('layouts.app')
@section('content')

<h1 class="text-center">Tratamientos</h1>

<!-- Agregar tratamiento -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
    Nuevo tratamiento
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
                <td>{{$tratamiento->precio}}</td>
                <td>
                    <!--editar-->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$tratamiento->id}}">
                        Editar
                    </button>

                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$tratamiento->id}}">
                        Eliminar
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