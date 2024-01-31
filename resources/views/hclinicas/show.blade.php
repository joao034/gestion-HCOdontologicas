@extends('layouts.app')
@section('content')
    <x-navegacion-paciente :paciente="$paciente" />
    <form>
        <div class="card">
            <div class="card-body">

                <div class="container">
                    <!--Titulo-->
                    <h3 class="text-center fw-bold g-2">Historia Clínica Odontológica</h3>

                    @include('hclinicas.components.datos_personales', ['modo' => 'show'])

                    @include('hclinicas.components.motivo_consulta', ['modo' => 'show'])

                    @include('hclinicas.components.enfermedad_actual', ['modo' => 'show'])

                    @include('hclinicas.components.antecedentes_personales', ['modo' => 'show'])

                    @include('hclinicas.components.constantes_vitales', ['modo' => 'show'])

                    @include('hclinicas.components.examen_sistema_estomatognatico', ['modo' => 'show'])

                    {{-- @include('hclinicas.components.diagnostico', ['modo' => 'show']) --}}

                    <div class="form-check mt-2">
                        <input class="form-check-input border-primary" type="checkbox" id="consentimiento"
                            {{ $paciente->consentimiento == true ? 'checked' : '' }} name="consentimiento" required>
                        <label class="form-check-label" for="consentimiento">
                            Acepto de manera libre y voluntaria dar mi consentimiento para la recolección, procesamiento y
                            uso de mis datos personales con fines médicos y en el contexto de la historia clínica
                            odontológica.
                        </label>
                    </div>
                </div>
    </form>
@endsection
