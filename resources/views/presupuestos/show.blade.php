@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <h3 class="text-center mt-4 fw-bold">Lista de presupuestos de {{$paciente->nombres . ' ' . $paciente->apellidos}}</h3>

    @if ($presupuestos->count() < 1)
        <p>No hay presupuestos</p>
    
    @else
        @foreach ($presupuestos as $presupuesto)
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('presupuestos.edit', $presupuesto->id) }}">
                    <x-card :title="'Presupuesto Nº ' . $presupuesto->id" :content="
                    '<p><strong>Última actualización: </strong>' .
                        $presupuesto->updated_at->format('d-m-Y') .
                    '</p>
                    <p><strong>Total: $ </strong>' .
                        $presupuesto->total .
                    '</p>'
                    " />
                </a>
            </div>
        @endforeach
    @endif
@endsection
