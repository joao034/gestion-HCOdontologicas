@php
    $rutas = [
        //'hclinicas.show' => 'Historia Clínica',
        'pacientes.edit' => 'Datos Personales',
        'consultas.edit' => 'Consulta',
        'detalleOdontogramas.show' => 'Odontograma',
        'examenesComplementarios.show' => 'Exámenes Complementarios',
        'diagnosticos.show' => 'Diagnóstico',
        'presupuestos.edit' => 'Presupuesto',
    ]; 
@endphp

<nav class="nav justify-content-center">
    @foreach ($rutas as $ruta => $nombre)
        <a class="nav-link active" aria-current="page" href="{{ route($ruta, $hClinica->id) }}">{{ $nombre }}</a>
    @endforeach
</nav>