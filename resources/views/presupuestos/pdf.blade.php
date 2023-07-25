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
        max-height: 80px;
    }

    .invoice-info {
        text-align: right;
    }

    /* Estilos para los datos del cliente */
    .client-info {
        margin-bottom: 20px;
    }

    .client-info p {
        margin: 5px 0;
    }

</style>

<div class="invoice-body">
    <!-- Cabecera de la factura -->
    <div class="invoice-header">
        <div class="company-logo">
            <p>Saúde Medical Group</p>
        </div>
        <div class="invoice-info">
            <h3>Presupuesto No. {{ $presupuesto->id }}</h3>
            <p>Fecha: {{$presupuesto->fecha_creacion}}</p>
            <!-- Otras informaciones de la factura -->
        </div>
    </div>

    <!-- Datos del cliente -->
    <div class="client-info">
        <h4>Información del Paciente</h4>
        <p><b>Nombre:</b> {{ $paciente->nombres }} {{ $paciente->apellidos }}</p>
        <p><b>Celular:</b> {{ $paciente->celular }}</p>
        <p><b>Dirección:</b> {{ $paciente->direccion }}</p>
    </div>

    <!-- Tabla de detalles de la factura -->
    <table class="invoice-table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nº</th>
                <th scope="col">Tratamiento</th>
                <th scope="col">Nº Diente</th>
                <th scope="col">Valor Unitario</th>
            </tr>
        </thead>
        <tbody>
            <!-- Si no hay resultados -->
            @if($detalles_presupuesto->count() < 1 )
                <tr>
                    <td colspan="4">No hay detalles del presupuesto.</td>
                </tr>
            @else
                <!-- Si hay resultados -->
                @foreach ($detalles_presupuesto as $detalle)
                    <tr>
                        <td scope="row">{{$detalle->id}}</td>
                        <td>{{$detalle->tratamiento->nombre}}</td>
                        <td>{{$detalle->num_pieza_dental}}</td>
                        <td>${{$detalle->tratamiento->precio}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right"><b>Total</b></td>
                    <td><b>${{$presupuesto->total}}</b></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
