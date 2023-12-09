<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col" class="col-md-1">Nº</th>
                <th scope="col" class="col-md-2">Fecha</th>
                <th scope="col" class="col-md-1">Tratamiento</th>
                <th scope="col" class="col-md-1">Diente</th>
                <th scope="col" class="col-md-2">Cara Dental</th>
                <th scope="col" class="col-md-2">Odontólogo</th>
                <th scope="col" class="col-md-1">Estado</th>
                <th scope="col" class="col-md-2">Acciones</th>
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
                        <td>{{ $detalle->fecha }}</td>
                        <td>{{ $detalle->tratamiento->nombre }}</td>
                        <td>{{ $detalle->num_pieza_dental }}</td>
                        <td>{{ $detalle->cara_dental }}</td>
                        <td>{{ $detalle->odontologo->nombres . ' ' . $detalle->odontologo->apellidos }}</td>
                        <td>{{ strtoupper($detalle->estado) }}</td>
                        <td>

                            <!--desactivar los botones de los detalles que no pertecen al usuario logueado-->
                            @if (Auth::user()->role === 'odontologo' && Auth::user()->odontologo->id === $detalle->odontologo->id)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i> Eliminar
                                </button>
                            @endif

                            @if (Auth::user()->role === 'admin')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#borrar{{ $detalle->id }}">
                                    <i class="fa-regular fa-trash-can"></i> Eliminar
                                </button>
                            @endif

                        </td>
                    </tr>
                    @include('odontogramas.destroy_detalle')
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $detalles_odontograma->links() }}
</div>
