@extends('layouts.app')
@section('content')
    <h3 class="text-center fw-bold">Top 3 pacientes con mayor monto de presupuesto</h3>
    <hr>
    <!-- Select para filtrar por año -->

    <form action="{{ route('reportes.top_pacientes_por_presupuesto') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="year" class="fw-bold">Año</label>
                <select class="form-control" id="year" name="year">
                    <option value="">Seleccione un año</option>
                    @foreach ($years as $year)
                        <!--Seleccionar el año actual-->
                        {{--  @if ($year->year == Carbon\Carbon::now()->year)
                            <option value="{{ $year->year }}" selected>{{ $year->year }}</option>
                        @endif --}}
                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Select para filtrar por mes -->
            <div class="col-md-4">
                <label for="month" class="fw-bold">Mes</label>
                <select class="form-control" id="month" name="month">
                    <option value="">Seleccione un mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="col-md-2">
                <!-- Boton para filtrar -->
                <label for="month" class="fw-bold">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control"><i class="fa-solid fa-magnifying-glass"></i>
                    Filtrar</button>
            </div>
    </form>

    <table class="table" id="table_presupuestos">
        
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Paciente</th>
                <th scope="col">Total</th>
                <th scope="col">Mes</th>
                <th scope="col">Año</th>
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
                    <td scope="row">{{ $resultado->nombre_paciente . ' ' . $resultado->apellido_paciente }}</td>
                    <td>$ {{ $resultado->total_ventas }}</td>
                    @php
                        //convertir el numero del mes a nombre
                        $mes = $resultado->mes;
                        switch ($mes) {
                            case 1:
                                $resultado->mes = 'Enero';
                                break;
                            case 2:
                                $resultado->mes = 'Febrero';
                                break;
                            case 3:
                                $resultado->mes = 'Marzo';
                                break;
                            case 4:
                                $resultado->mes = 'Abril';
                                break;
                            case 5:
                                $resultado->mes = 'Mayo';
                                break;
                            case 6:
                                $resultado->mes = 'Junio';
                                break;
                            case 7:
                                $resultado->mes = 'Julio';
                                break;
                            case 8:
                                $resultado->mes = 'Agosto';
                                break;
                            case 9:
                                $resultado->mes = 'Setiembre';
                                break;
                            case 10:
                                $resultado->mes = 'Octubre';
                                break;
                            case 11:
                                $resultado->mes = 'Noviembre';
                                break;
                            case 12:
                                $resultado->mes = 'Diciembre';
                                break;
                        }
                    @endphp
                    <td>{{ $resultado->mes }}</td>
                    <td>{{ $resultado->anio }}</td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!request()->ajax())
        <script src="{{ asset('assets/js/top-presupuestos.js') }}"></script>
    @endif
@endsection
