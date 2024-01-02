<style>
    /* Estilos para el cuerpo de la factura */
    .invoice-body {
        padding: 20px;
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
        text-align: center;
    }

    /* Estilos para los datos del cliente */
    .client-info {
        margin-bottom: 20px;
    }

    .client-info p {
        margin: 5px 0;
    }

    .center{
        text-align: center;
    }
</style>

<div class="invoice-body">
    <!-- Cabecera del presupuesto -->
    <div class="invoice-header">
        <div class="company-logo">
            <img src="assets/img/logo.png" alt="Logo de la empresa">
        </div>
        <div class="invoice-info">
            <h3>Lista de Pacientes del odontólogo/a {{ $odontologo->nombres . ' ' . $odontologo->apellidos }}</h3>
            <p> <b>Fecha:</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

     <!-- Tabla de detalles del presupuesto -->
     <table class="invoice-table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Paciente</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Celular</th>
                <th scope="col">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <!-- Si no hay resultados -->
            @if($pacientes->count() < 1 )
                <tr>
                    <td colspan="4">No hay resultados.</td>
                </tr>
            @else
                <!-- Si hay resultados -->
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td scope="row">{{$paciente->cedula}}</td>
                        <td>{{$paciente->nombres . ' ' . $paciente->apellidos}}</td>
                        <td>{{$paciente->fecha_nacimiento}}</td>
                        <td>{{$paciente->celular}}</td>
                        <td>{{$paciente->direccion}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
   
</div>
