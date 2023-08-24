<!-- Modal Nuevo -->
<div class="modal" tabindex="-1" id="create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Odontólogo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('odontologos.store') }}" method="post">
            @csrf
                      
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Nombres</label>
                      <input type="text"class="form-control form-control-sm" name="nombres" id="" 
                          aria-describedby="helpId" placeholder="" required>
                  </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Apellidos</label>
                      <input type="text"
                          class="form-control form-control-sm" name="apellidos" id="" 
                          aria-describedby="helpId" placeholder="" required>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Cédula</label>
                      <input type="text"class="form-control form-control-sm" name="cedula" id="cedula_odo" 
                              minlength="10" maxlength="10" 
                              aria-describedby="helpId" placeholder="" required>
                  </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Celular</label>
                      <input type="text"
                          class="form-control form-control-sm" name="celular" id="celu" minlength="10" maxlength="10" 
                          aria-describedby="helpId" placeholder="" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Especialidad</label>
                      <select class="form-select form-select-sm" required name="especialidad_id" required aria-label=".form-select-sm example">
                        <option>Seleccione una especialidad</option>
                        @foreach ($especialidades as $especialidad)
                        <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label for="" class="form-label">Género</label>
                      <select class="form-select form-select-sm" name="sexo" required aria-label=".form-select-sm example">
                        <option>Seleccione el género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                      </select>
                  </div>

                  </div>
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
    let cedulaOdo = document.getElementById('cedula_odo');
    apply_input_filter(cedulaOdo);
    
    let celu = document.getElementById('celu');
    apply_input_filter(celu);

    function apply_input_filter( input ){
      input.addEventListener('input', function() {
      // Filtrar y mantener solo los dígitos
      const filteredValue = this.value.replace(/\D/g, '');
      this.value = filteredValue;
      });
    }
</script>