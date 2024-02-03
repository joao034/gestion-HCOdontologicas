@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form>
        <div class="card">
            <div class="card-body">

                <button class="btn btn-primary mx-2" id="btn" type="button"><i class="fa-solid fa-notes-medical"></i> Exportar
                    Historia Clínica</button>
                <div class="container">
                    <!--Titulo-->

                    <h3 class="text-center fw-bold g-2">Historia Clínica Odontológica</h3>

                    @include('hclinicas.components.datos_personales', ['modo' => 'show'])

                    <div class="div" id="container">
                        <div class="div" id="titulo">
                            <h3 class="text-center fw-bold g-2" style="display: none;">Historia Clínica
                                Odontológica</h3>
                        </div>
                        @include('hclinicas.components.motivo_consulta', ['modo' => 'show'])

                        @include('hclinicas.components.enfermedad_actual', ['modo' => 'show'])

                        {{-- @include('hclinicas.components.antecedentes_personales', ['modo' => 'show']) --}}

                        @include('hclinicas.components.antecedentes_patologicos', ['modo' => 'show'])

                        @include('hclinicas.components.constantes_vitales', ['modo' => 'show'])

                        @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'show'])

                        <hr>
                        <h5 class="fw-bold mt-2">H. ODONTOGRAMA</h5>
                        <hr>
                        @include('odontogramas.odontograma', [
                            'modo' => 'show',
                            'odontograma' => $paciente->odontogramasCabecera->first(),
                        ])

                        @include('hclinicas.components.indices_cpo_ceo', ['modo' => 'show', 'odontograma' => $paciente->odontogramasCabecera->first()])

                        @include('hclinicas.components.exanenes_complementarios', ['modo' => 'show'])

                        @include('odontogramas.detalles_pdf', [
                            'modo' => 'show',
                            'detalles' => $paciente->odontogramasCabecera->first()->get_detalles(),
                        ])


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
            </div>
    </form>

    <script>
        document.getElementById('btn').addEventListener('click', function() {

            const titulo = document.getElementById('titulo');
            console.log(titulo);
            const datos = document.getElementById('container');

            // Crear un contenedor para ambos elementos
            const contenedor = document.createElement('div');

            // Agregar ambos elementos al contenedor
            contenedor.appendChild(titulo.cloneNode(true));
            contenedor.appendChild(datos.cloneNode(true));


            html2pdf()
                .set({
                    margin: 0.5,
                    filename: 'hclinica_{{ $paciente->cedula }}.pdf',
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
