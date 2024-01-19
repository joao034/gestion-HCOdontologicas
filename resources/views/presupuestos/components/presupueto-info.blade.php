<div class="card">
    <div class="card-body">
        <h4 class="card-title fw-bold text-center">Información del presupuesto Nº {{ $presupuesto->id }}</h4>
        <p class="card-text">Paciente :  {{ $presupuesto->paciente->nombres . ' ' . $presupuesto->paciente->apellidos }}</p>
        <p class="card-text">Fecha de creación : {{ \Carbon\Carbon::parse($presupuesto->created_at)->format('d/m/Y') }}</p>
        <h5>Presupuesto Total : ${{$presupuesto->total}}</h5>
        <h5>Realizado : ${{$total_realizado}}</h5>
        <h5>Abonado : ${{$total_abonado}}</h5>
        <h5>Saldo por abonar : ${{$presupuesto->total - $total_abonado}}</h5>
        @if ($total_realizado > $total_abonado)
            <h5 class="text-danger">Deuda: ${{ $total_realizado - $total_abonado}} </h5>
        @endif

        @if ( $total_abonado > $total_realizado)
            <h5 class="text-success">Saldo a favor: ${{ $total_abonado - $total_realizado}} </h5>
            
        @endif
    </div>
</div>
