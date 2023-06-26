<div class="modal fade" id="nuevo{{$odontograma->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Odontograma</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--Formulario-->
        <form action="{{ route('odontogramas.nuevo', ['paciente_id' => $odontograma->paciente_id]) }}" method="POST">
            @csrf 
            <input type="hidden" name="paciente_id" id="paciente_id">
            <input type="hidden" name="odontograma_id" id="odontograma_id">
            <div class="modal-body">
                ¿Desea crear un nuevo odontograma del paciente <strong>{{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos }}?</strong>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<script>
  function setPacienteId(paciente_id, odontograma_id){
    $('#paciente_id').val(paciente_id)
    $('#odontograma_id').val(odontograma_id)
  }
</script>
  