@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form>
        <div class="card">
            <div class="card-body">

                <button class="btn btn-primary" id="btn" type="button">Exportar</button>
                <div class="container" id="container">
                    <!--Titulo-->

                    <h3 class="text-center fw-bold g-2">Historia Clínica Odontológica</h3>

                    @include('hclinicas.components.datos_personales', ['modo' => 'show'])

                    @include('hclinicas.components.motivo_consulta', ['modo' => 'show'])

                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'show'])

                    {{-- @include('hclinicas.components.antecedentes_personales', ['modo' => 'show']) --}}

                    @include('hclinicas.components.antecedentes_patologicos', ['modo' => 'show'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'show'])

                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'show'])

                    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'show']) --}}

                    <div class="form-check mt-2">
                        <input class="form-check-input border-primary" type="checkbox" id="consentimiento"
                            {{ $paciente->consentimiento == true ? 'checked' : '' }} name="consentimiento" required>
                        <label class="form-check-label" for="consentimiento">
                            Acepto de manera libre y voluntaria dar mi consentimiento para la recolección, procesamiento
                            y
                            uso de mis datos personales con fines médicos y en el contexto de la historia clínica
                            odontológica.
                        </label>
                    </div>
                </div>
            </div>
    </form>

    <script>
        document.getElementById('btn').addEventListener('click', function() {

            const datos = document.getElementById('container');
            /* const odontograma = document.getElementById('odontograma');
            const detalles_odontograma = document.getElementById('detalles_odontograma'); */

            // Crear un contenedor para ambos elementos
            const contenedor = document.createElement('div');

            // Agregar ambos elementos al contenedor
            contenedor.appendChild(datos.cloneNode(true));
           /*  contenedor.appendChild(odontograma.cloneNode(true));
            contenedor.appendChild(detalles_odontograma.cloneNode(true)); */


            html2pdf()
                .set({
                    margin: 0.5,
                    filename: 'hclinica.pdf',
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
                        orientation: 'portrait'
                    }
                })
                .from(contenedor)
                .save()
                .catch(err => console.log(err));
        });
    </script>
@endsection
