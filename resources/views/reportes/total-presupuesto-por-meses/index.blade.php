@extends('layouts.app')
@section('content')
    <h3 class="text-center fw-bold">Monto total de presupuestos por meses</h3>
    <br>
    <!-- Select para filtrar por año -->
    <div class="row">
        <div class="col-md-4">

            <label for="year" class="fw-bold">Año</label>
            <select class="form-control" id="year" name="year">
                <option value="">Seleccione un año</option>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <table class="table" id="table_presupuestos">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Año</th>
                <th scope="col">Mes</th>
                <th scope="col">Monto Total</th>
            </tr>
        </thead>
        <tbody>

            @if (count($resultados) === 0)
                <tr>
                    <td colspan="4" class="">No hay resultados disponibles</td>
                </tr>
            @endif

            @foreach ($resultados as $resultado)
                <tr class="">
                    <td scope="row">{{ $resultado->year }}</td>
                    <td>{{ $resultado->month }}</td>
                    <td>${{ $resultado->total_por_mes }}</td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!request()->ajax())
        <script src="{{ asset('assets/js/presupuesto-por-meses.js') }}"></script>
    @endif
@endsection
