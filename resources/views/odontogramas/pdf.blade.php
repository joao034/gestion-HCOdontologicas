<style>
    .center {
        text-align: center
    }

    h2 {
        text-align: center
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .item {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 0.375rem;
        margin-top: 0.25rem;
        font-size: 1rem;
    }

    /* Estilos para la tabla */
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    .invoice-table th {
        background-color: #f2f2f2;
        text-align: center;
    }

    /* Estilos para la cabecera de la factura */
    .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .company-logo img {
        max-width: 200px;
        max-height: 100px;
    }

    .invoice-info {
        text-align: right;
    }

    /* Add more styles as needed */
</style>

<div>
    <h2>Historia Clínica Odontológica</h2>
    <h3 class="center">Saúde Medical Group</h3>
</div>

<div class="container">
    <h3>Datos Personales</h3>
    <hr>
    <div class="grid-container">
        <div class="item">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="{{ $paciente->nombres }}">
        </div>
        <div class="item">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="{{ $paciente->apellidos }}">
        </div>
        <div class="item">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" value="{{ $paciente->cedula }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento"
                value="{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Estado Civil</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="{{ $paciente->estado_civil }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Género</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="{{ $paciente->sexo }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Celular</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento"
                value="{{ $paciente->celular == null ? ' - ' : $paciente->celular }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Dirección</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="{{ $paciente->direccion }}">
        </div>
        <div class="item">
            <label for="fechaNacimiento">Profesión u ocupación</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="{{ $paciente->ocupacion }}">
        </div>
    </div>

    <hr>
    <h3>Diagnóstico</h3>
    <hr>
    <div class="item">
        <label for="nombres">Diagnóstico:</label>
        <input type="text" id="nombres" name="nombres" value="{{ $paciente->diagnostico == null ? ' - ' : $paciente->diagnostico->diagnostico }}">
    </div>
    <div class="item">
        <label for="nombres">Enfermedad Actual:</label>
        <input type="text" id="nombres" name="nombres" value="{{ $paciente->diagnostico == null ? ' - ' : $paciente->diagnostico->enfermedad_actual }}">
    </div>

</div>
{{-- <hr>
<h3>Odontograma</h3>


<hr> --}}
<hr>
<h3>Tratamientos</h3>
<hr>
<table class="invoice-table">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col" class="col">Fecha Hallazgo</th>
            <th scope="col" class="col">Fecha Realizado</th>
            <th scope="col" class="col">Tratamiento</th>
            <th scope="col" class="col">Nº Diente</th>
            <th scope="col" class="col">Cara dental</th>
            <th scope="col" class="col">Odontólogo</th>
            <th scope="col" class="col">Estado</th>
        </tr>
    </thead>
    <tbody>
        <!--Si no hay resultados-->
        @if ($odontograma_detalles->count() < 1)
            <tr>
                <td colspan="6">No hay detalles del presupuesto.</td>
            </tr>
        @else
            <!--Si hay resultados-->
            @foreach ($odontograma_detalles as $detalle)
                <tr class="">
                    <td>{{ $detalle->created_at->format('d/m/Y') }}</td>
                    <td>{{ $detalle->fecha_realizado }}</td>
                    <td>{{ $detalle->tratamiento->nombre }}</td>
                    <td>{{ $detalle->num_pieza_dental }}</td>
                    <td>{{ $detalle->cara_dental }}</td>
                    <td>{{ $detalle->odontologo->nombres . ' ' . $detalle->odontologo->apellidos }}</td>
                    <td>
                        {{ strtoupper($detalle->estado == 'necesario' ? ($detalle->estado = 'pendiente') : $detalle->estado) }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
