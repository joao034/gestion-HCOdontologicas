@extends('layouts.app')
@section('content')

<h3 class="fs-3 fw-bold text-center">Lista de Abonos del Presupuesto</h3>

<div class="table-responsive mx-4">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col" class="col-md-1">Nº</th>
                <th scope="col" class="col-md-1">Fecha</th>
                <th scope="col" class="col-md-4">Tratamiento Realizado</th>
                <th scope="col" class="col-md-1">Abono</th>
                {{-- <th scope="col" class="col-md-6">Acciones</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($abonos as $abono)
            <tr class="">
                <td scope="row">{{$abono->id}}</td>
                <td>{{\Carbon\Carbon::parse($abono->created_at)->format('d/m/Y')}}</td>
                <td>{{$abono->odontogramaDetalle->tratamiento->nombre}}</td>
                <td>$ {{$abono->monto}}</td>
                <td>
                    <!--editar-->
                    {{-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$tratamiento->id}}">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                    </button> --}}

                    <!--eliminar-->
                    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$tratamiento->id}}">
                        <i class="fa-regular fa-trash-can"></i> Eliminar
                    </button> --}}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
