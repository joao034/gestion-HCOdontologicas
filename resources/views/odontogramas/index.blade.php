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
                    <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
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
                    <th scope="col">Fecha de Creación</th>
                    <th scope="col">Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--Si no hay resultados-->
                @if($odontogramas->count() <= 0)
                    <tr>
                        <td colspan="6">No hay resultados</td>
                    </tr>
                @else
                    <!--Si hay resultados-->
                    @foreach ($odontogramas as $odontograma)
                    <tr class="">
                        <td scope="row">{{$odontograma->id}}</td>
                        <td>{{$odontograma->fecha_creacion}}</td>
                        <td>{{$odontograma->paciente->nombres}} {{$odontograma->paciente->apellidos}}</td>
                        
                        <td>
                            <!--editar-->
                            <a href=" {{ route('detalleOdontogramas.edit', $odontograma->id) }} " id="" class="btn btn-secondary" href="#" role="button">
                                <i class="fa-regular fa-pen-to-square"></i> Editar
                            </a>
        
                            <!--eliminar-->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$odontograma->id}}">
                                <i class="fa-regular fa-trash-can"></i> Eliminar
                            </button>

                            <!--nuevo-->
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#nuevo{{$odontograma->id}}">
                                <i class="fa-solid fa-plus"></i> Nuevo
                            </button>
        
                        </td>
                    </tr>
                    @include('odontogramas.destroy')
                    @include('odontogramas.nuevo')
                    @endforeach
                @endif
            </tbody>
        </table>
        <!--Paginacion-->
        {{$odontogramas->links()}}
    </div>


@endsection

