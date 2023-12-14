@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    
    {{-- <x-container-info-pacientes-navegacion :paciente="$paciente" :antecedentes="$antPersonales"></x-container-info-pacientes-navegacion> --}}

    <h3 class="text-center mt-4 fw-bold">Lista de odontogramas de {{$paciente->nombres . ' ' . $paciente->apellidos}}</h3>

    <!--Dropdown de los odontogramas del paciente-->
    {{-- <div class="dropdown d-flex justify-content-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Odontogramas
        </button>
    <ul class="dropdown-menu">
    @foreach ($paciente->odontogramasCabecera as $odontograma)
        <li>
            <a class="dropdown-item" href="{{route('detalleOdontogramas.edit', $odontograma->id)}}">
                Odontograma - {{ $odontograma->fecha_creacion }}
            </a>
        </li>
    @endforeach   --}}
    <!--Odontograma, si tiene solo uno que se muestre directamente-->

    @if ($odontogramas->count() < 1)
        <p>No hay odontogramas</p>
    @else
        @foreach ($odontogramas as $odontograma)
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('detalleOdontogramas.edit', $odontograma->id) }}">
                    <x-card :title="'ODONTOGRAMA Nº ' . $odontograma->id" :content="'<p><strong>Última actualización: </strong>' .
                        $odontograma->updated_at->format('d-m-Y') .
                        '</p>'" width="25rem" />
                </a>
            </div>
        @endforeach
    @endif
@endsection
