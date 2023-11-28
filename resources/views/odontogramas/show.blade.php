@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <h2 class="text-center mt-4">Odontogramas Geométricos</h2>

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

    @if (count($paciente->odontogramasCabecera) > 1)
        @foreach ($paciente->odontogramasCabecera as $odontograma)
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('detalleOdontogramas.edit', $odontograma->id) }}">
                <x-card :title="'ODONTOGRAMA Nº ' . $odontograma->id" 
                    :content="'<p><strong>Última actualización: </strong>'. $odontograma->updated_at->format('d-m-Y'). '</p>'" width="25rem" />
            </a>
        </div>
         @endforeach
    @else
        @php
            return to_route('detalleOdontogramas.edit', $paciente->odontogramasCabecera->id)
        @endphp
    @endif

@endsection
