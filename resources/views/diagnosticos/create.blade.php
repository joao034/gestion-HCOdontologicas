<div class="modal" tabindex="-1" id="create{{ $paciente->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Nuevo Diagnóstico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('diagnosticos.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    @include('hclinicas.components.diagnostico', ['modo' => 'create'])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
