<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">I. INDICADORES DE SALUD BUCAL</h5>
        <hr>
        <div class="table-responsive">
            <br>
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col" class="col">Nº</th>
                        <th scope="col" class="col">Diagnóstico</th>
                        <th scope="col" class="col">CIE</th>
                        <th scope="col" class="col">Tipo</th>
                        <th scope="col" class="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($paciente->diagnosticos as $diagnostico)
                        <tr class="">
                            <td scope="row">{{ $diagnostico->id }}</td>
                            <td>{{ $diagnostico->diagnostico }}</td>
                            <td>{{ $diagnostico->CIE }}</td>
                            <td>{{ strtoupper($diagnostico->tipo) }}</td>
                            <td>
                                <!--editar-->
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $diagnostico->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i> Editar
                                </button>

                            
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
