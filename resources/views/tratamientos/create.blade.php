<!-- Modal Editar -->
<div class="modal" tabindex="-1" id="create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Tratamiento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('tratamientos.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text"
                        class="form-control form-control-sm" name="nombre" id="" 
                        aria-describedby="helpId" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input type="number" step="any"
                        class="form-control form-control-sm" name="precio" id="" 
                        aria-describedby="helpId" placeholder="" required>
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