@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$odontograma->paciente" />

    <hr>
    <h5 class="text-center mt-4 mb-3 fw-bold">H. ODONTOGRAMA </h5>
    <hr>

    <h5 class="text-center"><span class="fw-bold">Paciente:</span>
        {{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos }}</h5>
    <h5 class="text-center mt-2 mb-4"><span class="fw-bold">Fecha de última actualización:</span>
        {{ \Carbon\Carbon::parse($odontograma->updated_at)->format('d/m/Y') }}</h5>

    <!-- Botones -->
    <div class="d-flex justify-content-between mt-2 mb-2">
        <div class="mb-2">
            <a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#nuevo{{ $odontograma->id }}"> <i
                    class="fa-solid fa-plus"></i> Nuevo Odontograma </a>
        </div>

        {{-- <div class="mb-2 mx-2">
            <a class="btn btn-info text-white" href="{{ route('odontogramas.pdf', $odontograma->id) }}" target="_blank"><i
                    class="fa-solid fa-notes-medical"></i> PDF Historia Clínica</a>
        </div> --}}

        {{-- <div class="mb-2 mx-2">
            <button type="button" id="btnGeneratePDF" class="btn btn-info text-white"><i
                    class="fa-solid fa-notes-medical"></i> PDF Historia Clínica</button>
        </div> --}}

        {{-- @include('odontogramas.sms') --}}

        <div class="mb-2">
            <a class="btn btn-secondary" href="{{ route('presupuestos.edit', $odontograma->id) }}"><i
                    class="fa-regular fa-file"></i> Ir al Presupuesto </a>
        </div>
    </div>

    <!-- Odontograma -->
    @include('odontogramas.odontograma')


    <!-- Lista de Detalles -->
    @include('presupuestos.components.add-detalle', ['presupuesto' => $odontograma])

    @include('indicadores_salud_bucal.edit')
    @include('indice_cpo.edit')

    @include('odontogramas.index_detalle')
    @include('odontogramas.detalle_odontograma')
    @include('odontogramas.nuevo')

    <!-- Tabla de detalles, solo funciona para exportar el pdf -->
    {{-- @include('odontogramas.detalles_pdf')
 --}}
    <script>
        document.getElementById('btnGeneratePDF').addEventListener('click', function() {

            const odontograma = document.getElementById('odontograma');
            const detalles_odontograma = document.getElementById('detalles_odontograma');

            // Crear un contenedor para ambos elementos
            const contenedor = document.createElement('div');

            // Agregar ambos elementos al contenedor
            contenedor.appendChild(odontograma.cloneNode(true));
            contenedor.appendChild(detalles_odontograma.cloneNode(true));

            html2pdf()
                .set({
                    margin: 0.5,
                    filename: 'odontograma.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 3,
                        letterRendering: true
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'a3',
                        orientation: 'landscape'
                    }
                })
                .from(contenedor)
                .save()
                .catch(err => console.log(err));
        });
    </script>
@endsection
