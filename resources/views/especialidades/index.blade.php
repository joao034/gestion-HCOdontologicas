@extends('layouts.app')
@section('content')
    <h1 class="text-center"><img class="svg-icon-index" src="assets/icons/especialidad.svg" alt=""> Especialidades</h1>

    <!-- Agregar tratamiento -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
        <i class="fa-solid fa-plus"></i> Nueva Especialidad
    </button>

    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col" class="col-md-3">Especialidad</th>
                    <th scope="col" class="col-md-4">Descripción</th>
                    <th scope="col" class="col-md-5">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especialidades as $especialidad)
                    <tr class="">
                        <td>{{ $especialidad->nombre }}</td>
                        <td>{{ $especialidad->descripcion }}</td>
                        <td>
                            <!--editar-->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $especialidad->id }}">
                                <i class="fa-regular fa-pen-to-square"></i> Editar
                            </button>

                            <!--eliminar-->
                            {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $especialidad->id }}">
                                <i class="fa-regular fa-trash-can"></i> Eliminar
                            </button> --}}

                        </td>
                    </tr>
                    @include('especialidades.info')
                @endforeach
            </tbody>
        </table>
    </div>
    @include('especialidades.create')
@endsection
