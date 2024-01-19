<div class="modal" id="abonar{{ $detalle->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Abonar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--Formulario-->
            <form action="{{ route('store.abono', $detalle->id) }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-body">

                    <h6 class="text-danger fw-bold">Saldo restante: $ {{ $detalle->precio - $detalle->abonos }}</h6>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="monto" aria-describedby="helpId"
                            id="monto" placeholder="Escriba el diagnóstico" autofocus>
                        <label for="monto" class="fw-bold">Abono ($) </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn_abonar" class="btn btn-primary">Abonar</button>
                </div>
            </form>
        </div>
    </div>
</div>
