<div class="modal" tabindex="-1" id="edit{{ $diagnostico->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Editar Diagnóstico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('diagnosticos.update', $diagnostico->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="hclinica_id" value="{{ $hClinica->id }}">
                    @include('hclinicas.components.diagnostico', ['modo' => 'edit'])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

