@extends('layouts.app')
@section('content')
    <h1 class="text-center"> <img class="svg-icon-index" src="assets/icons/presupuesto.svg" alt=""> Presupuestos</h1>
    
    <!--Input para buscar una historia-->
<form action="{{ route('presupuestos.index') }}" method="GET">
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
                <th scope="col">Cédula</th>
                <th scope="col">Paciente</th>
                <th scope="col">Presupuestos</th>
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
                    <td>{{$paciente->nombres . ' ' . $paciente->apellidos}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Presupuestos
                            </button>
                        <ul class="dropdown-menu">
                        @foreach ($paciente->odontogramasCabecera as $presupuesto)
                            <li>
                                <a class="dropdown-item" href="{{route('presupuestos.edit', $presupuesto->id)}}">
                                    Presupuesto - $ {{ $presupuesto->total }}
                                </a>
                            </li>
                        @endforeach  
                        </ul>
                        </div>
              
                </tr>

                @endforeach
            @endif
        </tbody>
    </table>
    <!--Paginacion-->
    {{$pacientes->links()}}
</div>


    
@endsection