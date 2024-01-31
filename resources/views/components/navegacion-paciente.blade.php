@php
    $rutas = [
        'hclinicas.show' => 'Historia Clínica',
        'odontogramas.show' => 'Odontogramas',
        'examenesComplementarios.show' => 'Exámenes Complementarios',
        'diagnosticos.show' => 'Diagnóstico',
        'presupuestos.show' => 'Presupuestos',
        'hclinicas.edit' => 'Editar Historia Clínica',
    ];
@endphp


<nav class="nav justify-content-center">
    <a class="nav-link active" aria-current="page" href="{{ route('hclinicas.show', $paciente->id) }}">Historia Clínica</a>
    <a class="nav-link" href="{{ route('odontogramas.show', $paciente->id) }}">Odontogramas</a>
    <a class="nav-link active" aria-current="page" href="{{ route('examenesComplementarios.show', $paciente->id) }}">Exámenes Complementarios</a>
    <a class="nav-link active" aria-current="page" href="{{ route('diagnosticos.show', $paciente->id) }}">Diagnóstico</a>
    <a class="nav-link" href="{{ route('presupuestos.show', $paciente->id) }}">Presupuestos</a>
    <a class="nav-link" href="{{ route('hclinicas.edit', $paciente->id) }}">Editar Historia Clínica</a>
</nav>