<div class="modal fade" id="delete{{ $diagnostico->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Diagnóstico</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Formulario-->
            <form action="{{ route('diagnosticos.destroy', $diagnostico->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    ¿Está seguro de eliminar el diagnóstico <strong>{{$diagnostico->diagnostico}}?</strong>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>