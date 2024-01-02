<div class="modal" tabindex="-1" id="edit{{ $tratamiento->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Editar Tratamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tratamientos.update', $tratamiento->id) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control form-control-md" name="nombre" id=""
                            value="{{ $tratamiento->nombre }}" aria-describedby="helpId" placeholder="" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Precio ($)</label>
                        <input type="number" step="any" value="{{ $tratamiento->precio }}"
                            class="form-control form-control-md" name="precio" id="" aria-describedby="helpId"
                            placeholder="" required>
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
<div class="modal fade" id="delete{{ $tratamiento->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Tratamiento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Formulario-->
            <form action="{{ route('tratamientos.destroy', $tratamiento->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    ¿Está seguro de eliminar al tratamiento <strong>{{ $tratamiento->nombre }}?</strong>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
