@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$presupuesto->paciente" />

    @include('presupuestos.components.presupueto-info')

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('presupuestos.pdf', $presupuesto->id) }}" class="btn btn-info text-white" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Descargar PDF
        </a>
        <a href="{{ route('presupuestos.enviar-mensaje', $presupuesto->id) }}" class="btn btn-info text-white">
            <i class="fa-solid fa-comment-sms"></i> Enviar el presupuesto
        </a>
    </div>

    {{-- @include('presupuestos.components.add-detalle') --}}

    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col" class="col">Nº</th>
                    <th scope="col" class="col">Tratamiento</th>
                    <th scope="col" class="col">Nº Diente</th>
                    <th scope="col" class="col">Valor Unitario ($)</th>
                    <th scope="col" class="col">Estado</th>
                    <th scope="col" class="col">Subtotal</th>
                    <th scope="col" class="col">Abonado</th>
                    <th scope="col" class="col">Saldo</th>
                    @if (Auth::user()->role == 'admin')
                        <th scope="col" class="col">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <!--Si no hay resultados-->
                @if ($detalles_presupuesto->count() < 1)
                    <tr>
                        <td colspan="6">No hay detalles del presupuesto.</td>
                    </tr>
                @else
                    <!--Si hay resultados-->
                    @foreach ($detalles_presupuesto as $detalle)
                        <tr class="">
                            <td scope="row">{{ $detalle->id }}</td>
                            <td>{{ $detalle->tratamiento->nombre }}</td>
                            <td>{{ $detalle->num_pieza_dental }}</td>
                            <td>
                                <form action="{{ route('update.precio', $detalle->id) }}" id="form" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input class="form-control form-control-md" type="number" id="precio" name="precio"
                                        {{ $detalle->estado == 'realizado' ? 'readonly' : '' }} step="any"
                                        value="{{ $detalle->precio }}">
                                </form>
                            </td>
                            <td class="{{ $detalle->estado == 'necesario' ? 'text-danger' : 'text-primary' }}">
                                {{ strtoupper($detalle->estado == 'necesario' ? ($detalle->estado = 'pendiente') : $detalle->estado) }}
                            </td>
                            <td>${{ $detalle->precio }}</td>

                            <td>$ {{ $detalle->abonos }}</td>
                            <td>$ {{ $detalle->precio - $detalle->abonos }}</td>

                            <td>
                                <!--Acciones -->
                                @if (Auth::user()->role == 'admin')
                                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#abonar{{ $detalle->id }}"
                                        {{ $detalle->precio - $detalle->abonos == 0 ? 'disabled' : '' }}>
                                        <i class="fa-solid fa-money-bill"></i> Abonar
                                    </button>
                                @endif

                                {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i> Eliminar
                                </button> --}}
                            </td>
                        </tr>
                        @include('presupuestos.abonar')
                        @include('presupuestos.destroy')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
