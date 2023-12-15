@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$presupuesto->paciente" />
    <h3 class="text-center mt-4 mb-3 fw-bold">Presupuesto de {{ $presupuesto->paciente->nombres . ' ' . $presupuesto->paciente->apellidos}}</h3>
    <h5 class="text-center mt-2 mb-4">Fecha de creación: {{ \Carbon\Carbon::parse($presupuesto->created_at)->format('d/m/Y') }}</h5>

    <div class="d-flex justify-content-between">
        <a href="{{ route('presupuestos.pdf', $presupuesto->id) }}" class="btn btn-info text-white" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Descargar PDF
        </a>
        <a href="{{ route('presupuestos.enviar-mensaje', $presupuesto->id) }}" class="btn btn-success text-white">
            <i class="fa-brands fa-whatsapp"></i> Enviar el presupuesto
        </a>
    </div>

    <form action="{{ route('presupuestos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="presupuesto_id" value="{{ $presupuesto->id }}">
        <div class="row mt-3">
            <div class="input-group mb-3">
                <div class="col-9 col-lg-5 col-md-7">
                    <select class="form-select form-select-md" name="tratamiento_id" required>
                        <option selected> ¿Desea agregar otro tratamiento?</option>
                        @foreach ($tratamientos as $tratamiento)
                            <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre . ' - $ ' . $tratamiento->precio }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" type="submit"><i class="fa-regular fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>


    </form>

    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col" class="col-1">Nº</th>
                    <th scope="col" class="col-3">Tratamiento</th>
                    <th scope="col" class="col-1">Nº Diente</th>
                    <th scope="col" class="col-2">Valor Unitario ($)</th>
                    <th scope="col" class="col-1">Total</th>
                    {{-- <th scope="col" class="col-4">Acciones</th> --}}
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
                                        step="any" value="{{ $detalle->precio }}">
                                </form>
                            </td>
                            <td>${{ $detalle->precio }}</td>
                            <td>

                                <!--eliminar -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i> Eliminar
                                </button>

                            </td>
                        </tr>
                        @include('presupuestos.destroy')
                    @endforeach
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>${{ $presupuesto->total }}</b></td>
                @endif
            </tbody>
        </table>
    </div>

    <script>
        /* document.addEventListener('DOMContentLoaded', function() {
            let precioInput = document.getElementById('precio');
            let form = document.getElementById('form');
            
            valorInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevenir el comportamiento predeterminado de Enter
                    form.submit();
                }
            });

            precioInput.addEventListener('blur', function() {
                form.submit();
            });
        }); */
    </script>

@endsection
