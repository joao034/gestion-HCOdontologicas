<div class="modal" id="borrar{{$detalle->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Detalle del Presupuesto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--Formulario-->
        <form action="{{ route('presupuestos.destroy', $detalle->id ) }}" method="POST">
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                ¿Está seguro de eliminar el tratamiento <strong>{{ $detalle->tratamiento->nombre }} </strong> del presupuesto?
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>