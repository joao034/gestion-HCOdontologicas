@extends('layouts.app')
@section('content')
    <h1 class="text-center">Lista de odontogramas</h1>

    <form action="{{ route('odontogramas.index') }}" method="GET">
        @csrf
        @method('GET')
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Buscar por cédula, nombres o apellidos" 
                value= "{{ $search }}" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-warning" type="submit" id="button-addon2">Buscar</button>
        </div>
    </form>
    
    <a name="" id="" class="btn btn-primary" href=" # " role="button">Nuevo Odontograma</a>
    
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
                            <a href=" {{ route('odontogramas.edit', $odontograma->id) }} " id="" class="btn btn-success" href="#" role="button">Editar</a>
        
                            <!--eliminar-->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$odontograma->id}}">
                                Eliminar
                            </button>
        
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!--Paginacion-->
    </div>
@endsection

