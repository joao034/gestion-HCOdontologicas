@extends('layouts.app')
@section('content')
    <h1 class="text-center">Presupuestos</h1>
    
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
            <div class="col-3">
                <button class="btn btn-warning" type="submit" id="button-addon2">Buscar</button>
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
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--Si no hay resultados-->
            @if($presupuestos->count() <= 0)
                <tr>
                    <td colspan="6">No hay resultados</td>
                </tr>
            @else
                <!--Si hay resultados-->
                @foreach ($presupuestos as $presupuesto)
                <tr class="">
                    <td scope="row">{{$presupuesto->id}}</td>
                    <td>{{$presupuesto->paciente->cedula}}</td>
                    <td>{{$presupuesto->paciente->nombres}}</td>
                    <td>{{$presupuesto->paciente->apellidos}}</td>
                    <td>${{$presupuesto->total}}</td>
                    <td>
                        
                        <!--editar-->
                        <a href="{{ route('presupuestos.edit', $presupuesto->id) }}" class="btn btn-success">Editar</a>

                    </td>
                </tr>

                @endforeach
            @endif
        </tbody>
    </table>
    <!--Paginacion-->

</div>


    
@endsection