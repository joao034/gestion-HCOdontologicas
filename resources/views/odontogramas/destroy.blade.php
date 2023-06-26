<div class="modal fade" id="delete{{$odontograma->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Odontograma</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--Formulario-->
        <form action="{{ route('odontogramas.destroy', $odontograma->id ) }}" method="POST">
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                ¿Está seguro de eliminar el odontograma de <strong>{{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos }}?</strong>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>