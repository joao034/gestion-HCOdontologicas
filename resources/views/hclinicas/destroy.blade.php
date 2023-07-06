  <!-- Modal Eliminar-->
  <div class="modal fade" id="delete{{$paciente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Historia Clínica</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--Formulario-->
        <form method="post" action="{{ route('hclinicas.destroy', $paciente->id) }}">
            @csrf  
            @method('DELETE')
            <div class="modal-body">
                ¿Está seguro de eliminar la historia clínica de <strong>{{ $paciente->nombres . ' ' .  $paciente->apellidos}}? </strong>
                  También se eliminarán sus odontogramas y sus presupuestos.
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>