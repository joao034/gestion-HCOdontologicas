<div class="modal" tabindex="-1" id="edit{{ $odontologo->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Odontólogo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('odontologos.update', $odontologo->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Nombres</label>
                    <input type="text"class="form-control form-control-sm" name="nombres" id="" 
                        value="{{$odontologo->nombres}}" aria-describedby="helpId" placeholder="" required>
                </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Apellidos</label>
                    <input type="text"
                        class="form-control form-control-sm" name="apellidos" id="" 
                        value="{{$odontologo->apellidos}}" aria-describedby="helpId" placeholder="" required>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Cédula</label>
                    <input type="text"class="form-control form-control-sm" name="cedula" id="cedula" minlength="10" maxlength="10"
                    value="{{$odontologo->cedula}}" aria-describedby="helpId" placeholder="" required>
                </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Celular</label>
                    <input type="text"
                        class="form-control form-control-sm" name="celular" id="celular" minlength="10" maxlength="10"
                        value="{{$odontologo->celular}}" aria-describedby="helpId" placeholder="" required>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Especialidad</label>
                    <select class="form-select form-select-sm" name="especialidad_id" required aria-label=".form-select-sm example" >
                      @foreach ($especialidades as $especialidad)
                        @if ($especialidad->id === $odontologo->especialidad_id)
                          <option value="{{$especialidad->id}}" selected>{{$especialidad->nombre}}</option>
                        @else                       
                          <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                        @endif
                      @endforeach
                    </select>
                </div>
              </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Sexo</label>
                    <select class="form-select form-select-sm" name="sexo" required aria-label=".form-select-sm example">
                        <option value="masculino" {{ $odontologo['sexo'] == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ $odontologo['sexo'] == 'femenino' ? 'selected' : '' }}>Femenino</option>
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

  <!-- Modal Eliminar-->
  <div class="modal fade" id="delete{{$odontologo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Odontólogo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--Formulario-->
        <form action="{{ route('odontologos.destroy', $odontologo->id ) }}" method="post">
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                Estas seguro de eliminar al odontólogo <strong>{{ $odontologo->nombres . ' ' . $odontologo->apellidos }}?</strong>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    let cedulaInput = document.getElementById('cedula');
    apply_input_filter(cedulaInput);
   
    let celularInput = document.getElementById('celular');
    apply_input_filter(celularInput);

    function apply_input_filter( input ){
        input.addEventListener('input', function() {
        // Filtrar y mantener solo los dígitos
        const filteredValue = this.value.replace(/\D/g, '');
        this.value = filteredValue;
        });
    }
</script>