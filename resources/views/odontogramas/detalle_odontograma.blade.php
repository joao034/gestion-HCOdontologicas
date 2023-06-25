<div class="modal fade" tabindex="-1" id="detalle_odontograma">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalle Odontograma</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form action=" {{ route('odontogramas.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type="hidden" name="odontograma_cabecera_id" id="odontograma_cabecera_id">
            <input type="hidden" name="cara_dental" id="cara_dental">
            <input type="hidden" name="num_pieza_dental" id="num_pieza_dental">
            <input type="hidden" name="simbolo_id" id="simbolo_id">

          <div class="row">
             <div class="mb-3">
              <label for="" class="form-label">Tratamientos</label>
              <select class="form-select form-select-md" name="tratamiento_id" id="">
                <option selected>Seleccione un tratamiento</option>
                @foreach ( $tratamientos as $tratamiento )
                  <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre.' - $'. $tratamiento->precio }}</option>
                @endforeach
              </select>
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
                        @foreach ( $simbolosRojos as $simboloRojo )
                          <button type="button" class="btn_simbolo_necesario" id="btn_simbolo" data-bs-toggle="tooltip" data-bs-title="Default tooltip"
                          onclick="agregar_simbolo( event, {{$simboloRojo->id}})"> @if ($simboloRojo->simbolo != 'ss') {{ $simboloRojo->simbolo }} @endif </button>
                        @endforeach
                      </div>
                    </div>
                    
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><label for="">Realizados</label>
                        <br>
                        <div class="contenedor-botones">
                          @foreach ( $simbolosAzules as $simboloAzul )
                          <button type="button" class="btn_simbolo_realizado" id="btn_simbolo" title=" {{ $simboloAzul->nombre }}"
                          onclick="agregar_simbolo( event, {{$simboloAzul->id}} )"> @if ($simboloAzul->simbolo != 'ss') {{ $simboloAzul->simbolo }} @endif  </button>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

          <div class="row mt-2">
            <div class="mb-3">
             <label for="" class="form-label">Odontólogos</label>
             <select class="form-select form-select-md" name="odontologo_id" id="">
               <option selected>Seleccione un odontólogo</option>
               @foreach ( $odontologos as $odontologo )
                 <option value="{{ $odontologo->id }}">{{ $odontologo->nombres . ' ' . $odontologo->apellidos . ' - ' . $odontologo->especialidad->nombre }}</option>
               @endforeach
             </select>
            </div>
         </div>

          <div class="row">
            <div class="mb-3">
              <label for="" class="form-label">Observación</label>
              <input type="text"
                class="form-control" name="observacion" id="" aria-describedby="helpId" placeholder="">
            </div>
          </div>


          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger float-left">Quitar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
    </div>
</div>

<script>
  function agregar_simbolo( event, simbolo_id ) {
    $('#simbolo_id').val( simbolo_id );
    //al hacer clicked se agrega o se quita el hover al boton 
    var boton = event.target;
    console.log(simbolo_id);
    if (boton.classList.contains("clicked")) {
      boton.classList.remove("clicked");
    } else {
      boton.classList.add("clicked");
    }
  }

  function crear( cara_dental, num_pieza_dental, odontograma_id ){
    $('#cara_dental').val(cara_dental);
    $('#num_pieza_dental').val(num_pieza_dental);
    $('#odontograma_cabecera_id').val(odontograma_id);
    $('#simbolo').val('');
    console.log(cara_dental, num_pieza_dental, odontograma_id);
  }

</script>