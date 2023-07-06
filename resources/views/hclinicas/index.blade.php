@extends('layouts.app')
@section('content')

<h1 class="text-center">Historias Clínicas Odontológicas</h1>

<!--Input para buscar una historia-->
<form action="{{ route('hclinicas.index') }}" method="GET">
    @csrf
    @method('GET')
    
    <div class="row">
        <div class="input-group mb-3">
            <div class="col-9 col-md-7 col-lg-5">
                <input type="text" class="form-control" name="buscador" placeholder="Buscar por cédula, nombres o apellidos" 
                    value= "{{ $search }}" aria-label="Recipient's username" aria-describedby="button-addon2">
            </div>
            <div class="col-3">
                <button class="btn btn-warning" type="submit" id="button-addon2">Buscar</button>
            </div>
        </div>
    </div>
</form>

<a href="{{ route('hclinicas.create') }}" class="btn btn-primary">Nueva historia clínica</a>


<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Cédula</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Edad</th>
                <th scope="col">Celular</th>
                <th>Acciones</th>
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
                    <td>{{$paciente->cedula}}</td>
                    <td>{{$paciente->nombres}}</td>
                    <td>{{$paciente->apellidos}}</td>
                    <td>{{$paciente->edad}}</td>
                    <td>{{$paciente->celular}}</td>
                    <td>
                        
                        <!--editar-->
                        <a href="{{ route('hclinicas.edit', $paciente->id) }}" class="btn btn-success">Editar</a>

                        <!--eliminar-->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">
                            Eliminar
                        </button>

                    </td>
                </tr>
                @include('hclinicas.destroy')
                @endforeach
            @endif
        </tbody>
    </table>
    <!--Paginacion-->
    {{$pacientes->links()}}

</div>

@endsection


