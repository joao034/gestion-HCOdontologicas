@extends('layouts.app')
@section('content')
    <form action="{{ route('hclinicas.store') }}" method="POST">
        @csrf
        <div class="card border">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center g-2 fw-bold">Historia Clínica Odontológica</h3>

                    @include('hclinicas.components.datos_personales', ['modo' => 'create'])

                    @include('hclinicas.components.motivo_consulta', ['modo' => 'create'])

                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'create'])

                    @include('hclinicas.components.antecedentes_personales', ['modo' => 'create'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'create'])

                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'create'])

                    @include('hclinicas.components.diagnostico', ['modo' => 'create'])
                   
                    <!--Fin Diagnostico-->
                    <!--Consentimiento-->
                    <div class="form-check mt-2">
                        <input class="form-check-input border-primary" type="checkbox" id="consentimiento"
                            name="consentimiento" required value="1" {{ old('consentimiento') ? 'checked' : '' }}>

                        <label class="form-check-label" for="consentimiento">
                            Acepto de manera libre y voluntaria dar mi consentimiento para la recolección, procesamiento
                            y
                            uso de mis datos personales con fines médicos y en el contexto de la historia clínica
                            odontológica.
                        </label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i>
                            Guardar Historia Clínica</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('assets/js/controles_hclinica.js') }}"> </script>
@endsection
