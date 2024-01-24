@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$presupuesto->paciente" />

    @include('presupuestos.components.presupueto-info')

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('presupuestos.pdf', $presupuesto->id) }}" class="btn btn-info text-white" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Descargar PDF
        </a>

        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
            data-bs-target="#enviar{{ $presupuesto->id }}">
            <i class="fa-solid fa-comment-sms"></i> Enviar el presupuesto
        </button>
    </div>

    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col" class="col"> </th>
                    <th scope="col" class="col">Tratamiento</th>
                    <th scope="col" class="col">Nº Diente</th>
                    <th scope="col" class="col-2">Valor Unitario ($)</th>
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
                            {{-- <td scope="row">{{ $detalle->id }}</td> --}}
                            @if ($detalle->precio - $detalle->abonos > 0)
                                <td>
                                    <input class="form-check-input border-primary" type="checkbox"
                                        id="detalle_{{ $detalle->id }}" name="detalles_check[]" autofocus
                                        value="{{ $detalle->id }}" data-precio={{ $detalle->precio - $detalle->abonos }}>
                                </td>
                            @else
                                <td></td>
                            @endif

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
                        @include('presupuestos.components.enviar_presupuesto')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @if (Auth::user()->role == 'admin')
        {{-- <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
            data-bs-target="#lista_abonos{{ $presupuesto->id }}">
            <i class="fa-solid fa-money-bill"></i> Ver Abonos
        </button>
        @include('abonos.show', ['abonos' => $presupuesto->abonos]) --}}
        <a href="{{ route('abonos.show', $presupuesto->id) }}">Ver Abonos</a>
        @include('presupuestos.components.abonar_multiple')
    @endif
@endsection
