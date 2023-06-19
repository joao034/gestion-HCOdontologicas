<div class="modal fade" tabindex="-1" id="detalle_odontograma">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalle Odontograma</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form action="">
        
          <div class="row">
             <div class="mb-3">
              <label for="" class="form-label">Tratamientos</label>
              <select class="form-select form-select-md" name="tratamiento_id" id="">
                <option selected>Select one</option>
                @foreach ( $tratamientos as $tratamiento )
                  <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre }}</option>
                @endforeach
              </select>
             </div>
          </div>

          <!--Simbolos-->

          <div class="row" style="margin-top: 5px;border-top: solid 1px #F6ECEC;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;display: none;" id="div_simbolos">
                <button type="button" class="btn btn-danger btn-sm" onclick="ad_simbolo(1)">X</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="ad_simbolo(2)">X</button>

                <button type="button" class="btn btn-danger btn-sm" onclick="ad_simbolo(3)">&#9650;</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="ad_simbolo(4)">&#9650;</button> 

                <button type="button" class="btn btn-danger btn-sm" onclick="ad_simbolo(5)">O</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="ad_simbolo(6)">O</button>

                <button type="button" class="btn btn-primary btn-sm" onclick="ad_simbolo(7)">I</button>

                <button type="button" class="btn btn-danger btn-sm" onclick="ad_simbolo(8)">S</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="ad_simbolo(9)">S</button>
                <button type="button" class="btn btn-default btn-sm" onclick="ad_simbolo(10)">S</button>
            </div>       
          </div>

          <div class="row">
            <div class="mb-3">
              <label for="" class="form-label">Observación</label>
              <input type="text"
                class="form-control" name="observacion" id="" aria-describedby="helpId" placeholder="">
            </div>
          </div>


          </form>
        </div>

        


        <div class="modal-footer">
          <button type="button" class="btn btn-danger float-left">Quitar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
</div>

<script>
  function ad_simbolo(simbol) {
    $('#simbolo').val(simbol);
  }
</script>