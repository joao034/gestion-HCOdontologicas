<div class="modal fade" tabindex="-1" id="editarDetalle{{ $detalle->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Detalle Odontograma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('detalleOdontogramas.update', $detalle->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                
                    <!--Estado-->
                    <div class="row">
                        <label for="" class="form-label fw-bold">Estado</label>
                        <div class="mb-3">
                            <select class="form-select form-select-md" autofocus name="estado" id="" required
                                autofocus>
                                <option value="necesario" {{ $detalle->estado === 'necesario' ? 'selected' : '' }}>
                                    Pendiente</option>
                                <option value="realizado" {{ $detalle->estado === 'realizado' ? 'selected' : '' }}>
                                    Realizado</option>
                            </select>
                        </div>
                    </div>

                    <!--Tratamiento-->
                    <div class="row">
                        <label for="" class="form-label fw-bold">Tratamiento</label>
                        <div class="mb-3">
                            <select class="form-select form-select-md" autofocus name="tratamiento_id" id=""
                                required disabled>
                                <option value="{{ $detalle->tratamiento_id }}">
                                    {{ $detalle->tratamiento->nombre }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!--Simbolos-->
                    {{-- <div class="row" style="margin-top: 5px;border-top:">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">Símbolos</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><label
                                            for="">Necesarios</label>
                                        <br>
                                        <div class="contenedor-botones">
                                            <div class="row" id="div_simbolo_rojo" style="display: none;">
                                                <button type="button" class="btn_simbolo_necesario" id="btn_simbolo"
                                                    data-bs-placement="bottom"
                                                    onclick="agregar_simbolo( event, {{ $simboloRojo->id }})">
                                            </div>
                                            <div class="row" style="display: none;" id="div_simbolos">
                                                @foreach ($simbolosRojos as $simboloRojo)
                                                    <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                                                        <button type="button" class="btn_simbolo_necesario"
                                                            id="btn_simbolo" data-bs-placement="bottom"
                                                            title="{{ $simboloRojo->nombre }}"
                                                            onclick="agregar_simbolo( event, {{ $simboloRojo->id }})">
                                                            <!-- Comprueba que solo aparezca con simbolos los botones que tengan uno -->
                                                            @if ($simboloRojo->simbolo != 'ss')
                                                                {{ $simboloRojo->simbolo }}
                                                            @endif
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><label
                                            for="">Realizados</label>
                                        <br>
                                        <div class="contenedor-botones">
                                            <div class="row" id="div_simbolo_azul" style="display: none;">
                                                <button type="button" class="btn_simbolo_realizado" id="btn_simbolo"
                                                    data-bs-placement="bottom"
                                                    onclick="agregar_simbolo( event, {{ $simboloAzul->id }})">
                                            </div>
                                            <div class="row" style="display: none;" id="div_simboloss">
                                                @foreach ($simbolosAzules as $simboloAzul)
                                                    <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                                                        <button type="button" class="btn_simbolo_realizado"
                                                            id="btn_simbolo" title=" {{ $simboloAzul->nombre }}"
                                                            onclick="agregar_simbolo( event, {{ $simboloAzul->id }} )">
                                                            @if ($simboloAzul->simbolo != 'ss')
                                                                {{ $simboloAzul->simbolo }}
                                                            @endif
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!--Odontologos-->
                    <div class="row mt-2">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Odontólogo</label>
                            <select required class="form-select form-select-md" name="odontologo_id" id="">
                                @if (Auth::user()->role === 'admin')
                                    <option selected>Seleccione un odontólogo</option>
                                    @foreach ($odontologos as $odontologo)
                                        <option value="{{ $odontologo->id }}"
                                            {{ $odontologo->id === $detalle->odontologo_id ? 'selected' : '' }}>
                                            {{ $odontologo->nombres . ' ' . $odontologo->apellidos . ' - ' . $odontologo->especialidad->nombre }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="{{ Auth::user()->odontologo->id }}" selected>
                                        {{ Auth::user()->odontologo->nombres . ' ' . Auth::user()->odontologo->apellidos . ' - ' . Auth::user()->odontologo->especialidad->nombre }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!--Observacion-->
                    <div class="row">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Observación</label>
                            <input type="text" class="form-control" name="observacion" id=""
                                aria-describedby="helpId" placeholder="Escriba alguna observacion"
                                value="{{ $detalle->observacion }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    //muestra el div de caras dentales si el tratamiento es resina
    $(document).ready(function() {
        $('#tratamientos').change(function() {
            let selectedOptionText = $(this).find(':selected').text();
            if (selectedOptionText.includes('RESINA') && !selectedOptionText.includes('RESINA SIMPLE'))
                $('#div_caras_dentales').show();
            else
                $('#div_caras_dentales').hide();
        });
    });

    //al hacer clicked se agrega o se quita el hover al boton
    function agregar_simbolo(event, simbolo_id) {
        $('#simbolo_id').val(simbolo_id); 
        let boton = event.target;
        if (boton.classList.contains("clicked"))
            boton.classList.remove("clicked");
        else
            boton.classList.add("clicked");

    }

    function crear(cara_dental, num_pieza_dental, odontograma_id) {
        $('#cara_dental').val(cara_dental);
        $('#num_pieza_dental').val(num_pieza_dental);
        $('#odontograma_cabecera_id').val(odontograma_id);
        $('#simbolo').val('');
        asignarValueCaraDental(num_pieza_dental);
        mostrarSimboloSegunCaraDental(cara_dental);
    }


    function mostrarSimboloSegunCaraDental(cara_dental) {
        if (cara_dental == 'oclusal') {
            $('#div_simbolos').show();
            $('#div_simboloss').show();
            $('#div_simbolo_rojo').hide();
            $('#div_simbolo_azul').hide();
        } else {
            $('#div_simbolos').hide();
            $('#div_simboloss').hide();
            $('#div_simbolo_rojo').show();
            $('#div_simbolo_azul').show();
        }
    }

    //asigna el value al check palatino o lingual segun el numero de pieza dental
    function asignarValueCaraDental(num_pieza_dental) {
        let check_palatino = document.getElementById('checkPalatino');
        if ((num_pieza_dental >= 11 && num_pieza_dental <= 28) || (num_pieza_dental >= 51 && num_pieza_dental <= 65))
            check_palatino.value = 'palatino';
        else
            check_palatino.value = 'lingual';
    }
</script> --}}

