@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$odontograma->paciente" />

    <h3 class="text-center mt-4 mb-3 fw-bold">Odontograma de
        {{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos }}</h3>

    <h5 class="text-center mt-2 mb-4">Fecha de última actualización:
        {{ \Carbon\Carbon::parse($odontograma->updated_at)->format('d/m/Y') }}</h5>

    <!-- Botones -->
    <div class="d-flex justify-content-between mt-2 mb-2">
        <div class="mb-2">
            <a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#nuevo{{ $odontograma->id }}"> <i
                    class="fa-solid fa-plus"></i> Nuevo Odontograma </a>
        </div>

        <div class="mb-2 mx-2">
            <a class="btn btn-info text-white" href="{{ route('odontogramas.pdf', $odontograma->id) }}" target="_blank"><i class="fa-solid fa-notes-medical"></i> Exportar Historia Clínica</a>
        </div>
        

        <div class="mb-2">
            <a class="btn btn-secondary" href="{{ route('presupuestos.edit', $odontograma->id) }}"><i
                    class="fa-regular fa-file"></i> Ir al Presupuesto </a>
        </div>
    </div>

    <!-- Odontograma -->
    @include('odontogramas.odontograma')

    <!-- Lista de Detalles -->
    @include('presupuestos.components.add-detalle', ['presupuesto' => $odontograma])
    @include('odontogramas.index_detalle')
    @include('odontogramas.detalle_odontograma')
    @include('odontogramas.nuevo')
@endsection
