<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Fecha Hallazgo</th>
                <th scope="col">Fecha Realizado</th>
                <th scope="col">Tratamiento</th>
                <th scope="col">Diente</th>
                <th scope="col">Cara Dental</th>
                <th scope="col">Odontólogo</th>
                <th scope="col">Estado</th>
                <th scope="col">Observación</th>
                <th scope="col">Acciones</th>
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
                        <td scope="row">{{ $detalle->id }}</td>
                        <td>{{ $detalle->created_at->format('d-m-Y') }}</td>
                        <td>{{ $detalle->fecha_realizado == null ? ' - ' : \Carbon\Carbon::parse($detalle->fecha_realizado)->format('d-m-Y') }}</td>
                        <td>{{ $detalle->tratamiento->nombre }}</td>
                        <td>{{ $detalle->num_pieza_dental }}</td>
                        <td>{{ $detalle->cara_dental }}</td>
                        <td>{{ $detalle->odontologo->nombres . ' ' . $detalle->odontologo->apellidos }}</td>
                        <td>{{ strtoupper($detalle->estado) }}</td>
                        <td>{{ $detalle->observacion }}</td>
                            <!--desactivar los botones de los detalles que no pertecen al usuario logueado-->
                            @if (Auth::user()->role === 'odontologo' && Auth::user()->odontologo->id === $detalle->odontologo->id)
                            <td>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#editarDetalle{{ $detalle->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            @endif

                            @if (Auth::user()->role === 'admin')
                            <td>
                                <button type="button" class="btn btn-info text-white mb-1" data-bs-toggle="modal"
                                    data-bs-target="#editarDetalle{{ $detalle->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i> 
                                </button>
                            @endif
                            </td>
                    </tr>
                    @include('odontogramas.destroy_detalle')
                    @include('detalleOdontogramas.edit')
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $detalles_odontograma->links() }}
</div>
