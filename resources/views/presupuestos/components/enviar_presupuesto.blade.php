<div class="modal" id="enviar{{ $presupuesto->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Enviar el Presupuesto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Formulario-->
            <form action="{{ route('presupuestos.enviar-mensaje', $presupuesto->id) }}" method="GET">
                @csrf
                @method('GET')
                <div class="modal-body">
                    ¿Desea enviar el presupuesto al celular <strong> {{ $hClinica->paciente->celular}}</strong> del paciente <strong>{{ $hClinica->paciente->nombreCompleto()  }} </strong> ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
