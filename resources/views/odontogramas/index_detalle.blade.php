<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Fecha</th>
                <th scope="col">Tratamiento</th>
                <th scope="col">Diente</th>
                <th scope="col">Cara Dental</th>
                <th scope="col">Odontólogo</th>
                <th scope="col">Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--Si no hay resultados-->
            @if($detalles_odontograma->count() < 1 )
                <tr>
                    <td colspan="6">No hay detalles del odontograma.</td>
                </tr>
            @else
                <!--Si hay resultados-->
                @foreach ($detalles_odontograma as $detalle)
                <tr class="">
                    <td scope="row">{{$detalle->id}}</td>
                    <td>{{$detalle->fecha}}</td>
                    <td>{{$detalle->tratamiento->nombre}}</td>
                    <td>{{$detalle->num_pieza_dental}}</td>
                    <td>{{$detalle->cara_dental}}</td>
                    <td>{{$detalle->odontologo->nombres . ' '. $detalle->odontologo->apellidos }}</td>
                    <td>{{$detalle->estado}}</td>
                    <td>

                        <!--eliminar-->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrar{{$detalle->id}}">
                            <i class="fa-regular fa-trash-can"></i> Eliminar
                        </button>
                    </td>
                </tr>
                @include('odontogramas.destroy_detalle')
                @endforeach
            @endif
        </tbody>
    </table>
    {{$detalles_odontograma->links()}}
</div>
