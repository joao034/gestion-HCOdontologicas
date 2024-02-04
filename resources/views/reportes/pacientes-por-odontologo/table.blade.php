<div class="table-responsive" id="pacientesContainer">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nro. de identificación</th>
                <th scope="col">Paciente</th>
                <th scope="col">Edad</th>
                <th scope="col">Celular</th>
                <th scope="col">Dirección</th>
                <th scope="col">Historia Clínica</th>
            </tr>
        </thead>
        <tbody>

            @if (count($pacientes) == 0)
                <tr>
                    <td colspan="4" class="">No tiene pacientes con tratamientos pendientes</td>
                </tr>
            @endif

            @foreach ($pacientes as $paciente)
                <tr class="">
                    <td scope="row">{{ $paciente->cedula }}</td>
                    <td>{{ $paciente->nombres . ' ' . $paciente->apellidos }}</td>
                    <td>{{ $paciente->edad() }}</td>
                    <td>{{ $paciente->celular }}</td>
                    <td>{{ $paciente->direccion }}</td>

                    <td>
                        <a href="{{ route('hclinicas.show', $paciente->id) }}" class="btn btn-secondary"><i
                                class="fa-regular fa-pen-to-square"></i> Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pacientes->appends(['odontologo_id' => $odontologoId])->links() }}
</div>
