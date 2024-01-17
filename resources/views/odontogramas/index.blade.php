<!-- No se usa -->
@extends('layouts.app')
@section('content')
    <h1 class="text-center"><img src="assets/icons/diente.png"> Lista de odontogramas</h1>

    <form action="{{ route('odontogramas.index') }}" method="GET">
        @csrf
        @method('GET')
        <div class="row">
            <div class="input-group mb-3">
                <div class="col-9 col-md-7 col-lg-5">
                    <input type="text" class="form-control" name="search" placeholder="Buscar por cédula, nombres o apellidos" 
                        value= "{{ $search }}" aria-label="Recipient's username" aria-describedby="button-addon2">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary" type="submit" id="button-addon2">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>
            </div>
        </div>
    </form>
    
    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Fecha de actualización</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Odontogramas</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--Si no hay resultados-->
                @if($pacientes->count() <= 0)
                    <tr>
                        <td colspan="6">No hay resultados</td>
                    </tr>
                @else
                    <!--Si hay resultados-->
                    @foreach ($pacientes as $paciente)
                    <tr class="">
                        <td scope="row">{{$paciente->id}}</td>
                        <td>{{$paciente->nombres}}</td>
                        <td>{{$paciente->nombres}} {{$paciente->apellidos}}</td>
                        <td>
                            <!--Dropdown de odontogramas-->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Odontogramas
                                </button>
                            <ul class="dropdown-menu">
                            @foreach ($paciente->odontogramasCabecera as $odontograma)
                                <li>
                                    <a class="dropdown-item" href="{{route('detalleOdontogramas.edit', $odontograma->id)}}">
                                        Odontograma - {{ $odontograma->fecha_creacion }}
                                    </a>
                                </li>
                            @endforeach  
                            </ul>
                            </div>
                        </td>

                        <td>
                            <!--editar-->
                            {{-- <a href="{{route('detalleOdontogramas.edit', $odontograma->id)}}" id="" class="btn btn-secondary" href="#" role="button">
                                <i class="fa-regular fa-pen-to-square"></i> Editar
                            </a> --}}
        
                            <!--eliminar-->
                            {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">
                                <i class="fa-regular fa-trash-can"></i> Eliminar
                            </button> --}}

                            <!--nuevo-->
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#nuevo{{$odontograma->id}}">
                                <i class="fa-solid fa-plus"></i> Nuevo
                            </button> 
        
                        </td>
                    </tr>
                    {{-- @include('odontogramas.destroy') --}}
                    @include('odontogramas.nuevo')
                    @endforeach
                @endif
            </tbody>
        </table>
        <!--Paginacion-->
        {{$pacientes->links()}}
    </div>


@endsection

