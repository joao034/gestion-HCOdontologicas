<div class="table-responsive" >
    <table class="table" id="detalles_odontograma" >
        <h4>Tratamientos</h4>
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Fecha Hallazgo</th>
                <th scope="col">Fecha Realizado</th>
                <th scope="col">Tratamiento</th>
                <th scope="col">Diente</th>
                <th scope="col">Cara Dental</th>
                <th scope="col">Odontólogo</th>
                <th scope="col">Estado</th>
                <th scope="col">Observación</th>
            </tr>
        </thead>
        <tbody>
            <!--Si no hay resultados-->
            @if ($detalles_odontograma->count() < 1)
                <tr>
                    <td colspan="6">No hay detalles del odontograma.</td>
                </tr>
            @else
                <!--Si hay resultados-->
                @foreach ($detalles_odontograma as $detalle)
                    <tr class="">
                        <td>{{ $detalle->created_at->format('d-m-Y') }}</td>
                        <td>{{ $detalle->fecha_realizado == null ? ' - ' : \Carbon\Carbon::parse($detalle->fecha_realizado)->format('d-m-Y') }}
                        </td>
                        <td>{{ $detalle->tratamiento->nombre }}</td>
                        <td>{{ $detalle->num_pieza_dental }}</td>
                        <td>{{ $detalle->cara_dental }}</td>
                        <td>{{ $detalle->odontologo->nombres . ' ' . $detalle->odontologo->apellidos }}</td>
                        <td class="{{ $detalle->estado == 'necesario' ? 'text-danger' : 'text-primary' }}">
                            {{ strtoupper($detalle->estado == 'necesario' ? ($detalle->estado = 'pendiente') : $detalle->estado) }}
                        </td>
                        <td>{{ $detalle->observacion }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $detalles_odontograma->links() }}
</div>
