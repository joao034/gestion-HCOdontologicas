<div class="modal fade" tabindex="-1" id="detalle_odontograma">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalle Odontograma</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form action=" {{ route('detalleOdontogramas.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type="hidden" name="odontograma_cabecera_id" id="odontograma_cabecera_id">
            <input type="hidden" name="cara_dental[]" id="cara_dental">
            <input type="hidden" name="num_pieza_dental" id="num_pieza_dental">
            <input type="hidden" name="simbolo_id" id="simbolo_id">

          <!--Tratamientos-->
          <div class="row">
             <div class="mb-3">
              <select class="form-select form-select-md" name="tratamiento_id" id="tratamientos" required>
                <option selected>Seleccione un tratamiento</option>
                @foreach ( $tratamientos as $tratamiento )
                  <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre.' - $'. $tratamiento->precio }}</option>
                @endforeach
              </select> 
             </div>
          </div>

          <!--Caras dentales-->
          <div class="row" id="div_caras_dentales" style="display:none">
            <label for="" class="form-label">Caras dentales</label>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkOclusal" name="cara_dental[]" value="oclusal">
                <label class="form-check-label" for="checkOclusal">
                  Oclusal
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkVestibular" name="cara_dental[]" value="vestibular">
                <label class="form-check-label" for="checkVestibular">
                  Vestibular
                </label>
                </div>
              </div>
            <div class="col-md-4">
              <input class="form-check-input" type="checkbox" id="checkMesial" name="cara_dental[]" value="mesial">
              <label class="form-check-label" for="checkMesial">
                Mesial
              </label>
            </div>
            <div class="col-md-4">
              <input class="form-check-input" type="checkbox" id="checkPalatino" name="cara_dental[]">
              <label class="form-check-label" for="checkPalatino">
                Palatino/Lingual
              </label>
            </div>
            <div class="col-md-4">
              <input class="form-check-input" type="checkbox" id="checkDistal" name="cara_dental[]" value="distal">
              <label class="form-check-label" for="checkDistal">
                Distal
              </label>
            </div>
          </div>

          <!--Simbolos-->
          <div class="row" style="margin-top: 5px;border-top:"> 
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Símbolos</h6>
                <hr>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><label for="">Necesarios</label>
                      <br>
                      <div class="contenedor-botones">
                        <div class="row" id="div_simbolo_rojo" style="display: none;">
                          <button type="button" class="btn_simbolo_necesario" id="btn_simbolo" data-bs-placement="bottom"
                            onclick="agregar_simbolo( event, {{$simboloRojo->id}})">
                        </div>
                        <div class="row" style="display: none;" id="div_simbolos">
                          @foreach ( $simbolosRojos as $simboloRojo )
                          <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                              <button type="button" class="btn_simbolo_necesario" id="btn_simbolo" data-bs-placement="bottom" title="{{ $simboloRojo->nombre }}"
                                onclick="agregar_simbolo( event, {{$simboloRojo->id}})">
                                <!-- Comprueba que solo aparezca con simbolos los botones que tengan uno --> 
                                @if ($simboloRojo->simbolo != 'ss') {{ $simboloRojo->simbolo }} @endif 
                            </button>
                          </div>    
                          @endforeach
                        </div>
                      </div>
                    </div>
                    
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><label for="">Realizados</label>
                        <br>
                        <div class="contenedor-botones">
                          <div class="row" id="div_simbolo_azul" style="display: none;">
                            <button type="button" class="btn_simbolo_realizado" id="btn_simbolo" data-bs-placement="bottom"
                              onclick="agregar_simbolo( event, {{$simboloAzul->id}})">
                          </div>
                          <div class="row" style="display: none;" id="div_simboloss">
                            @foreach ( $simbolosAzules as $simboloAzul )
                              <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                                <button type="button" class="btn_simbolo_realizado" id="btn_simbolo" title=" {{ $simboloAzul->nombre }}"
                                onclick="agregar_simbolo( event, {{$simboloAzul->id}} )"> @if ($simboloAzul->simbolo != 'ss') {{ $simboloAzul->simbolo }} @endif  </button>
                              </div>   
                            @endforeach
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>  

          <!--Odontologos-->
          <div class="row mt-2">
            <div class="mb-3">
             <label for="" class="form-label">Odontólogos</label>
             <select required class="form-select form-select-md" name="odontologo_id" id="">
               <option selected>Seleccione un odontólogo</option>
               @foreach ( $odontologos as $odontologo )
                 <option value="{{ $odontologo->id }}">{{ $odontologo->nombres . ' ' . $odontologo->apellidos . ' - ' . $odontologo->especialidad->nombre }}</option>
               @endforeach
             </select>
            </div>
         </div>

         <!--Observacion-->
          <div class="row">
            <div class="mb-3">
              <label for="" class="form-label">Observación</label>
              <input type="text"
                class="form-control" name="observacion" id="" aria-describedby="helpId" placeholder="">
            </div>
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

<script>
//muestra el div de caras dentales si el tratamiento es resina
$(document).ready(function(){
    $('#tratamientos').change(function(){
      var selectedOptionText = $(this).find(':selected').text();
      if (selectedOptionText.includes('RESINA') && !selectedOptionText.includes('RESINA SIMPLE')) 
        $('#div_caras_dentales').show();
      else 
        $('#div_caras_dentales').hide();
    });
  });

  function agregar_simbolo( event, simbolo_id ) {
    $('#simbolo_id').val( simbolo_id );
    //al hacer clicked se agrega o se quita el hover al boton 
    var boton = event.target;
    if (boton.classList.contains("clicked")) 
      boton.classList.remove("clicked");
    else 
      boton.classList.add("clicked");
    
  }

  function crear( cara_dental, num_pieza_dental, odontograma_id ){
    $('#cara_dental').val(cara_dental);
    $('#num_pieza_dental').val(num_pieza_dental);
    $('#odontograma_cabecera_id').val(odontograma_id);
    $('#simbolo').val('');
    asignarValueCaraDental( num_pieza_dental );
    mostrarSimboloSegunCaraDental( cara_dental );
  }


  function mostrarSimboloSegunCaraDental( cara_dental ){
    if( cara_dental == 'oclusal' ){
      $('#div_simbolos').show();
      $('#div_simboloss').show();
      $('#div_simbolo_rojo').hide();
      $('#div_simbolo_azul').hide();
    }else{
      $('#div_simbolos').hide();
      $('#div_simboloss').hide();
      $('#div_simbolo_rojo').show();
      $('#div_simbolo_azul').show();
    }
  }

  //asigna el value al check palatino o lingual segun el numero de pieza dental
  function asignarValueCaraDental ( num_pieza_dental ){
    let check_palatino = document.getElementById('checkPalatino');
    if( (num_pieza_dental >= 11 && num_pieza_dental <= 28) || (num_pieza_dental >= 51 && num_pieza_dental <= 65) )
      check_palatino.value = 'palatino';
    else 
      check_palatino.value = 'lingual';
  }

</script>
