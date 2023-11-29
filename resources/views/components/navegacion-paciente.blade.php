<nav class="nav justify-content-center">
    <a class="nav-link active" aria-current="page" href="{{ route('hclinicas.show', $paciente->id) }}">Historia Clínica</a>
    <a class="nav-link" href="{{ route('odontogramas.show', $paciente->id) }}">Odontogramas</a>
    <a class="nav-link" href="{{ route('presupuestos.show', $paciente->id) }}">Presupuestos</a>
    <a class="nav-link" href="{{ route('hclinicas.edit', $paciente->id) }}">Editar Historia Clínica</a>
</nav>