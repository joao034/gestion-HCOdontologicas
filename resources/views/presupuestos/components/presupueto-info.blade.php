<div class="card">
    <div class="card-body">
        <h4 class="card-title fw-bold text-center mb-4">Presupuesto Nº {{ $presupuesto->id }}</h4>

        <a class="btn btn-info float-end text-white" href="{{ route('detalleOdontogramas.show', $presupuesto->id) }}"><i
                class="fa-solid fa-tooth"></i> Ir al
            odontograma</a>

        <h6 class="fs-5"><strong>Paciente:</strong>
            {{ $presupuesto->paciente->nombres . ' ' . $presupuesto->paciente->apellidos }}</h6>
        <h6 class="fs-5"><strong>Fecha de Creación:</strong>
            {{ \Carbon\Carbon::parse($presupuesto->created_at)->format('d/m/Y') }}</h6>
        <hr>

        <div class="table-responsive mx-4">
            <table class="table  table-bordered table-hover table-md">
                <tbody>
                    <tr class="">
                        <td scope="col" class="text-primary fs-5"><strong>Presupuesto Total:</strong></td>
                        <td class="text-primary fs-5"> <strong>${{ $presupuesto->total }}</strong></td>
                    </tr>
                    <tr class="">
                        <td scope="col"><strong>Realizado:</strong></td>
                        <td>${{ $total_realizado }}</td>
                    </tr>
                    <tr class="">
                        <td scope="col"><strong>Abonado:</strong></td>
                        <td>${{ $total_abonado }}</td>
                    </tr>
                    <tr class="">
                        <td scope="col"><strong>Saldo por Abonar:</strong></td>
                        <td>${{ $presupuesto->total - $total_abonado }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row text-center mt-1">
            @if ($total_realizado > $total_abonado)
                <h6 class="fs-5 text-danger"><strong>Deuda: ${{ $total_realizado - $total_abonado }}</strong></h6>
            @endif

            @if ($total_abonado > $total_realizado)
                <h6 class="fs-5 text-success"><strong>Saldo a Favor:
                        ${{ $total_abonado - $total_realizado }}</strong></h6>
            @endif
        </div>
    </div>
</div>
