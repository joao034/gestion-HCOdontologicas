<!-- Modal Editar -->
<div class="modal" tabindex="-1" id="create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Nueva Especialidad</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('especialidades.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Nombre</label>
                    <input type="text"
                        class="form-control form-control-md" name="nombre" id="" 
                        aria-describedby="helpId" placeholder="Ingrese el nombre de la especialidad" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Descripción</label>
                    <input type="text"
                        class="form-control form-control-md" name="descripcion" id="" 
                        aria-describedby="helpId" placeholder="Escriba una descripción corta de lo que trata la especialidad" required>
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