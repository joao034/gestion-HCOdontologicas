<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-bold">Buscar Pacientes</h5>
        <hr>
        <form action="{{ route('reportes.get_pacientes_por_odontologo') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <select class="form-select form-select-md" name="odontologo_id" required id="odontologo_id" autofocus
                        onchange="syncSelect(this.value, 'odontologo_id_origen')">
                        <option value="">Seleccione un odontólogo</option>
                        @if (Auth::user()->role === 'admin')
                            @foreach ($odontologos as $odontologo)
                                <option value="{{ $odontologo->id }}"
                                    {{ old('odontologo_id', $odontologoId) == $odontologo->id ? 'selected' : '' }}>
                                    {{ $odontologo->get_full_name() . '  - ' . $odontologo->get_nombres_especialidades() }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ Auth::user()->odontologo->id }}"
                                {{ old('odontologo_id', Auth::user()->odontologo->id) == Auth::user()->odontologo->id ? 'selected' : '' }}>
                                {{ Auth::user()->odontologo->get_full_name() . '  - ' . Auth::user()->odontologo->get_nombres_especialidades() }}
                            </option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info text-white"><i class="fa-solid fa-magnifying-glass"></i>
                        Buscar</button>
                </div>
                
                <div class="col">
                    <a type="button" class="btn btn-danger" id="generatePdfBtn">
                        <i class="fa-solid fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $("#generatePdfBtn").click(function () {
        let odontologoId = $("#odontologo_id_origen").val();
        window.open(
            "/reportes/pdf/pacientes-por-odontologo?odontologo_id_origen=" +
                odontologoId,
            "_blank"
        );
    });
</script>