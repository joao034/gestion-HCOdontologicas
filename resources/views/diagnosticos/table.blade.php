<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col" class="col">Nº</th>
                <th scope="col" class="col">Diagnóstico</th>
                <th scope="col" class="col">CIE</th>
                <th scope="col" class="col">Tipo</th>
                @if ($modo == 'edit')
                    <th scope="col" class="col">Acciones</th>
                @endif

            </tr>
        </thead>
        <tbody>
           
            {{-- @if ($hClinica->diagnostico->isEmpty())
                <td>No hay diagnósticos del paciente</td>
            @else
                @foreach ($hClinica->diagnosticos as $diagnostico)
                    <tr class="">
                        <td scope="row">{{ $diagnostico->id }}</td>
                        <td>{{ $diagnostico->diagnostico }}</td>
                        <td>{{ $diagnostico->CIE }}</td>
                        <td>{{ strtoupper($diagnostico->tipo) }}</td>

                        @if ($modo == 'edit')
                            <td>
                                <!--editar-->
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $diagnostico->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i> Editar
                            </button>

                            </td>
                        @endif

                    </tr>
                    @include('diagnosticos.edit')
                    @include('diagnosticos.delete')
                @endforeach
            @endif --}}

        </tbody>
    </table>
</div>
