@extends('layouts.app')
@section('content')

<h1 class="text-center"> <img class="svg-icon-index" src="assets/icons/user.svg" alt=""> Usuarios</h1>

<!-- Agregar tratamiento -->
<a href="{{ route('users.create') }}" type="button" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Nuevo Usuario
</a>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col" class="col">Nombre de Usuario</th>
                <th scope="col" class="col">Email</th>
                <th scope="col" class="col">Rol</th>
                <th scope="col" class="col">Estado</th>
                <th scope="col" class="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="">
                <td scope="row">{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{strtoupper($user->role)}}</td>
                <td>{{$user->active == 1 ? 'ACTIVO' : 'INACTIVO'}}</td>
                <td>
                    <!--editar-->
                    <a type="button" class="btn btn-secondary" href="{{ route('users.edit', $user->id) }}">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                    </a>

                    <!--eliminar-->
                    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{$user->id}}">
                        <i class="fa-regular fa-trash-can"></i> Eliminar
                    </button> --}}
                </td>
            </tr>
            @include('users.delete')
            @endforeach
        </tbody>
    </table>
</div>
@endsection