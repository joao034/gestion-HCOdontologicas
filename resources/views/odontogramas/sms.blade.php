<button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
    data-bs-target="#enviar{{ $odontograma->id }}">
    <i class="fa-solid fa-comment-sms"></i> Enviar el la hclinica
</button>


<div class="modal" id="enviar{{ $odontograma->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Enviar la Historia Clinica</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--Formulario-->
            <form action="{{ route('odontogramas.enviar-mensaje', $odontograma->id) }}" method="GET">
                @csrf
                @method('GET')
                <div class="modal-body">
                    ¿Desea enviar la historia clínica al celular <strong> {{ $odontograma->paciente->celular}}</strong> del paciente <strong>{{ $odontograma->paciente->nombres . ' ' . $odontograma->paciente->apellidos  }} </strong> ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
