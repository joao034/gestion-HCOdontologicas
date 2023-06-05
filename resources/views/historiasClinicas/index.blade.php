@extends('layouts.app')
@section('content')

<a href="{{ route('hclinicas.create') }}" class="btn btn-primary">Nuevo pintura</a>


<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Siglo / Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinturas as $pintura)
            <tr class="">
                <td scope="row">{{$pintura->id}}</td>
                <td>{{$pintura->codigo}}</td>
                <td>{{$pintura->nombre}}</td>
                <td>{{$pintura->siglo_año}}</td>
                <td>
                    <!-- Mostrar -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show{{$pintura->id}}">
                        Mostrar
                    </button>
                    <!--editar-->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$pintura->id}}">
                        Editar
                    </button>
                    <!--eliminar-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$pintura->id}}">
                        Eliminar
                    </button>

                </td>
            </tr>
            @include('pinturas.info')
            @endforeach

        </tbody>
    </table>
</div>

@endsection


