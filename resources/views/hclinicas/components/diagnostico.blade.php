{{-- <div class="row justify-content-center mt-4">
    <div class="card text-start">
        <div class="card-body">
            <h5 class="card-title fw-bolder">Diagnóstico</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="diagnostico" id="diagnostico"
                            aria-describedby="helpId" placeholder="Escriba el diagnóstico"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $diagnostico?->diagnostico : old('diagnostico') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="diagnostico" class="fw-bold">Diagnóstico</label>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="enfermedad_actual" id="enfermedad_actual"
                            aria-describedby="helpId" placeholder="Escriba la enfermedad actual"
                            value="{{ $modo == 'show' || $modo == 'edit' ? $diagnostico?->enfermedad_actual : old('enfermedad_actual') }}"
                            {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="enfermedad_actual" class="fw-bold">Enfermedad Actual</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@php
    $tipo_diagnostico = [
        'preventivo' => 'PRE',
        'definitivo' => 'DEF',
    ];
@endphp

<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">N. DIAGNÓSTICO</h5>
        <hr>
        <div class="div" id="contenedorFilas">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nombre" id="diagnostico"
                            aria-describedby="helpId" placeholder="Escriba el diagnóstico"
                            {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="diagnostico" class="fw-bold">Diagnóstico</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="CIE" id="diagnostico"
                            aria-describedby="helpId" placeholder="CIE" {{ $modo == 'show' ? 'readonly' : '' }}>
                        <label for="diagnostico" class="fw-bold">CIE</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" name="tipo" id="tipo"
                            {{ $modo == 'show' ? 'disabled' : '' }}>
                            <option value="" selected>Seleccione</option>
                            @foreach ($tipo_diagnostico as $key => $tipo)
                                <option value="{{ $key }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                        <label for="tipo" class="fw-bold">Tipo</label>
                    </div>
                </div>
            </div>

        </div>

        <button id="addFila" class="btn btn-primary mt-2 float-end">Agregar Fila</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#addFila").click(function() {
            // Clona la última fila y la inserta después de la última fila
            $(".row:last").clone().insertAfter(".row:last");
            // Limpia los valores de los inputs y selects en la nueva fila
            $(".row:last input, .row:last select").val("");
        });
    });
</script>

{{-- <script>
    $(document).ready(function() {
        $("#agregarFila").click(function() {
            // Clona la última fila y la inserta después de la última fila
            var nuevaFila = $(".fila:last").clone();
            nuevaFila.find('input, select').val(
            ""); // Limpia los valores de los inputs y selects en la nueva fila
            nuevaFila.appendTo("#contenedor-filas");
        });

        $("#enviarFormulario").click(function() {
            // Procesar los datos de todas las filas
            var datos = [];
            $(".fila").each(function(index) {
                var filaActual = {};
                $(this).find('input, select').each(function() {
                    filaActual[$(this).attr('name')] = $(this).val();
                });
                datos.push(filaActual);
            });

            // Enviar los datos al servidor (puedes usar AJAX o incluir estos datos en el formulario principal)
            console.log(datos);
            // Aquí puedes enviar los datos al servidor a través de AJAX o agregarlos a un formulario principal antes de enviarlo.
        });
    });
</script> --}}
