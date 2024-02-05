<div class="d-flex flex-wrap">

    @if ($modo == 'show')
        <div class="col-md-8">
            <label for="nombres" class="form-label fw-bold">Odontólogo</label>
            <input type="text"
                value="{{ $paciente->historias_clinicas->first()?->odontologo->get_full_name() . ' - ' . $paciente->historias_clinicas->first()?->odontologo->get_nombres_especialidades() }}"
                class="form-control" id="" aria-describedby="helpId" placeholder="Odontólogo responsable" readonly>
        </div>
    @else
        {{-- @include('components.select_odontologos_activos') --}}
        <div class="mb-3">
            <label for="" class="form-label fw-bold">Odontólogo</label>
            <select required class="form-select form-select-md" name="odontologo_id" id="odontologoSelect"
                onchange="selectOdontologo()">
                @if (Auth::user()->role === 'admin')
                    <option value="" selected>Seleccione un odontólogo</option>
                    @foreach ($odontologos as $user)
                        <option value="{{ $user->odontologo->id }}" data-registro={{ $user->odontologo->cedula }}
                            {{ $paciente->historias_clinicas->first()?->odontologo->id == $user->odontologo->id ? 'selected' : '' }}>
                            {{ $user->odontologo->get_full_name() . ' - ' . $user->odontologo->get_nombres_especialidades() }}
                        </option>
                    @endforeach
                @endif
                @if (Auth::user()->role === 'odontologo')
                    @if ($paciente->historias_clinicas->first()?->odontologo == null)
                        <option value="" selected>Seleccione un odontólogo</option>
                        <option value="{{ Auth::user()->odontologo->id }}"
                            data-registro={{ Auth::user()->odontologo->cedula }}>
                            {{ Auth::user()->odontologo->get_full_name() . ' - ' . Auth::user()->odontologo->get_nombres_especialidades() }}
                        </option>
                    @else
                        <option value="{{ $paciente->historias_clinicas->first()?->odontologo->id }}" selected
                            data-registro={{ $paciente->historias_clinicas->first()?->odontologo->cedula }}>
                            {{ $paciente->historias_clinicas->first()?->odontologo->get_full_name() . ' - ' . $paciente->historias_clinicas->first()?->odontologo->get_nombres_especialidades() }}
                        </option>
                    @endif
                @endif
            </select>
        </div>
    @endif

    <div>
        <label for="nombres" class="form-label fw-bold">Número de registro</label>
        <input type="text" value="{{ $paciente->historias_clinicas->first()?->odontologo->cedula }}"
            id="numero_registro" {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" id=""
            aria-describedby="helpId" placeholder="Número de registro" readonly>
    </div>
</div>

<script>
    function selectOdontologo() {
        // Obtener el elemento select
        let selectElement = document.getElementById('odontologoSelect');

        // Obtener el valor de la cédula del odontólogo seleccionado
        let cedulaValue = selectElement.options[selectElement.selectedIndex].getAttribute('data-registro');

        // Establecer el valor de la cédula en el atributo data-registro
        selectElement.setAttribute('data-registro', cedulaValue);

        // Obtener el input de la cédula y seterle el valor
        let inputCedula = document.getElementById('numero_registro');
        inputCedula.value = cedulaValue;
    }
</script>
