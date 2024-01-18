{{-- Muestra lista de odotonogramas de un paciente --}}
@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />

    <h3 class="text-center mt-4 fw-bold">Lista de odontogramas de {{$paciente->nombres . ' ' . $paciente->apellidos}}</h3>

    @if ($odontogramas->count() < 1)
        <p>No hay odontogramas</p>
    @else
        @foreach ($odontogramas as $odontograma)
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('detalleOdontogramas.show', $odontograma->id) }}">
                    <x-card :title="'ODONTOGRAMA Nº ' . $odontograma->id" :content="'<p><strong>Última actualización: </strong>' .
                        $odontograma->updated_at->format('d-m-Y') .
                        '</p>'" width="25rem" />
                </a>
            </div>
        @endforeach
    @endif
@endsection
