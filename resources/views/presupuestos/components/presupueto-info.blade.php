<div class="card">
    <div class="card-body">
        <h4 class="card-title fw-bold text-center mb-4">Información del Presupuesto Nº {{ $presupuesto->id }}</h4>
        <h6 class="fs-5"><strong>Paciente:</strong>
            {{ $presupuesto->paciente->nombres . ' ' . $presupuesto->paciente->apellidos }}</h6>
        <h6 class="fs-5"><strong>Fecha de Creación:</strong>
            {{ \Carbon\Carbon::parse($presupuesto->created_at)->format('d/m/Y') }}</h6>
        <hr>

        <div class="table-responsive mx-4" >
            <table class="table table-striped table-bordered table-hover table-md">
                <tbody>
                    <tr class="">
                        <td scope="col" class="fs-5" ><strong>Presupuesto Total:</strong></td>
                        <td class="text-primary fs-5"> ${{ $presupuesto->total }}</td>
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
                <h6 class="fs-5 text-danger"><strong>Deuda:</strong> ${{ $total_realizado - $total_abonado }}</h6>
            @endif

            @if ($total_abonado > $total_realizado)
                <h6 class="fs-5 text-success"><strong>Saldo a Favor:</strong>
                    ${{ $total_abonado - $total_realizado }}</h6>
            @endif
        </div>

        {{-- <div class="container text-center">
            <div class="d-flex justify-content-between">
                <div class="col-md-5">
                    <h6 class="fs-5"><strong>Presupuesto Total:</strong></h6>
                    <h6 class="fs-5"><strong>Realizado:</strong></h6>
                    <h6 class="fs-5"><strong>Abonado:</strong> </h6>
                    <h6 class="fs-5"><strong>Saldo por Abonar:</strong> </h6>
                </div>
                <div class="col-md-5">
                    <h6 class="fs-5"> ${{ $presupuesto->total }}</h6>
                    <h6 class="fs-5">${{ $total_realizado }}</h6>
                    <h6 class="fs-5"> ${{ $total_abonado }}</h6>
                    <h6 class="fs-5"> ${{ $presupuesto->total - $total_abonado }}</h6>
                </div>
            </div>
            
        </div> --}}


        {{--  <div class="container text-center">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <h6 class="fs-5"><strong>Presupuesto Total:</strong></h6>
                    <h6 class="fs-5"><strong>Realizado:</strong></h6>
                    <h6 class="fs-5"><strong>Abonado:</strong> </h6>
                    <h6 class="fs-5"><strong>Saldo por Abonar:</strong> </h6>
                </div>
                <div class="col-md-5">
                    <h6 class="fs-5"> ${{ $presupuesto->total }}</h6>
                    <h6 class="fs-5">${{ $total_realizado }}</h6>
                    <h6 class="fs-5"> ${{ $total_abonado }}</h6>
                    <h6 class="fs-5"> ${{ $presupuesto->total - $total_abonado }}</h6>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                @if ($total_realizado > $total_abonado)
                    <h6 class="fs-5 text-danger"><strong>Deuda:</strong> ${{ $total_realizado - $total_abonado }}</h6>
                @endif

                @if ($total_abonado > $total_realizado)
                    <h6 class="fs-5 text-success"><strong>Saldo a Favor:</strong>
                        ${{ $total_abonado - $total_realizado }}</h6>
                @endif
            </div>
        </div> --}}
    </div>
</div>
