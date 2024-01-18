<div class="modal" id="abonar{{ $detalle->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Abonar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--Formulario-->
            <form action="{{ route('presupuestos.update', $detalle->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="precio" aria-describedby="helpId"
                            id="precio" placeholder="Escriba el diagnóstico" value="{{ $detalle->precio }}" readonly>
                        <label for="precio" class="fw-bold">Precio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="abono" aria-describedby="helpId"
                            id="abono" placeholder="Escriba el diagnóstico" autofocus>
                        <label for="abono" class="fw-bold">Abono</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="saldo" aria-describedby="helpId"
                            id="saldo" placeholder="Escriba el diagnóstico" readonly>
                        <label for="saldo" class="fw-bold">Saldo</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Abonar</button>
                </div>
            </form>
        </div>
    </div>
</div>
