@extends('layouts.app')
@section('content')
    <h2 class="text-center">Detalle Presupuesto</h2>

    <form action="{{ route('presupuestos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="presupuesto_id" value="{{$presupuesto->id}}">
        <div class="container mt-4">
            <div class="row">
                <div class="col-9 col-md-7 col-lg-5">
                    <div class="mb-3">
                        <select class="form-select form-select-md" name="tratamiento_id" required>
                            <option selected> ¿Desea agregar otro tratamiento?</option>
                            @foreach ($tratamientos as $tratamiento)
                                <option value="{{$tratamiento->id}}">{{ $tratamiento->nombre .' - $ '. $tratamiento->precio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <button id="" class="btn btn-primary" type="submit"><i class="fa-regular fa-plus"></i> Agregar</button>
                </div>
            </div>
            <div class="col">
                <a href="{{ route('presupuestos.pdf', $presupuesto->id) }}" class="btn btn-danger" target="_blank"><i class="fa-solid fa-file-pdf"></i> Descargar PDF</a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Tratamiento</th>
                    <th scope="col">Nº Diente</th>
                    <th scope="col">Valor Unitario</th>
                    <th scope="col">Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--Si no hay resultados-->
                @if($detalles_presupuesto->count() < 1 )
                    <tr>
                        <td colspan="6">No hay detalles del presupuesto.</td>
                    </tr>
                @else
                    <!--Si hay resultados-->
                    @foreach ($detalles_presupuesto as $detalle)
                    <tr class="">
                        <td scope="row">{{$detalle->id}}</td>
                        <td>{{$detalle->tratamiento->nombre}}</td>
                        <td>{{$detalle->num_pieza_dental}}</td>
                        <td>${{$detalle->tratamiento->precio}}</td>
                        <td>${{$detalle->tratamiento->precio}}</td>
                        <td>
    
                            <!--eliminar-->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrar{{$detalle->id}}">
                                <i class="fa-regular fa-trash-can"></i> Eliminar
                            </button>
    
                        </td>
                    </tr>
                    @include('presupuestos.destroy')
                    @endforeach
                    <td></td><td></td><td></td>
                    <td><b>Total</b></td>
                    <td><b>${{$presupuesto->total}}</b></td>
                @endif
            </tbody>
        </table>
    </div>

@endsection