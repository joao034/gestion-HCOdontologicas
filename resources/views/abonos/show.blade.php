<div class="modal" id="lista_abonos{{ $presupuesto->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Ver Abonos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h3 class="fs-5 fw-bold text-center">Lista de Abonos del Presupuesto Nº {{$presupuesto->id}}</h3>

                <div class="table-responsive mx-4">
                    <br>
                    <table class="table">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tratamiento Realizado</th>
                                <th scope="col">Pieza dental</th>
                                <th scope="col">Abono</th>
                                {{-- <th scope="col" class="col-md-6">Acciones</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abonos as $abono)
                                <tr class="">
                                    <td scope="row">{{ $abono->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($abono->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $abono->odontogramaDetalle->tratamiento->nombre }}</td>
                                    <td>{{ $abono->odontogramaDetalle->num_pieza_dental }}</td>
                                    <td>$ {{ $abono->monto }}</td>
                                    <td>
                                        <!--editar-->
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$tratamiento->id}}">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                    </button> --}}

                                        <!--eliminar-->
                                        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$tratamiento->id}}">
                        <i class="fa-regular fa-trash-can"></i> Eliminar
                    </button> --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

