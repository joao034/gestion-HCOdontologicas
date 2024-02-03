<div class="d-flex flex-wrap">

    @if ($modo == 'show')
        <div class="col-md-8">
            <label for="nombres" class="form-label fw-bold">Odontólogo</label>
            <input type="text" value="{{ $paciente->historias_clinicas->first()?->odontologo->get_full_name() . ' - ' . $paciente->historias_clinicas->first()?->odontologo->get_nombres_especialidades()}}"
                class="form-control" id="" aria-describedby="helpId" placeholder="Odontólogo responsable" readonly>
        </div>
    @else
        {{-- @include('components.select_odontologos_activos') --}}
        <div class="mb-3">
            <label for="" class="form-label fw-bold">Odontólogo</label>
            <select required class="form-select form-select-md" name="odontologo_id" id="">
                @if (Auth::user()->role === 'admin')
                    <option value="" selected>Seleccione un odontólogo</option>
                    @foreach ($odontologos as $user)
                        <option value="{{ $user->odontologo->id }}"
                            {{ $paciente->historias_clinicas->first()?->odontologo->id == $user->odontologo->id ? 'selected' : '' }}>
                            {{ $user->odontologo->get_full_name() . ' - ' . $user->odontologo->get_nombres_especialidades() }}
                        </option>
                    @endforeach
                @else
                    <option value="{{ Auth::user()->odontologo->id }}" selected>
                        {{ Auth::user()->odontologo->get_full_name() . ' - ' . Auth::user()->odontologo->get_nombres_especialidades() }}
                    </option>
                @endif
            </select>
        </div>
    @endif

    <div>
        <label for="nombres" class="form-label fw-bold">Número de registro</label>
        <input type="text" value="{{ $paciente->historias_clinicas->first()?->odontologo->cedula }}"
            {{ $modo == 'show' ? 'readonly' : '' }} class="form-control" id="" aria-describedby="helpId"
            placeholder="Número de registro" readonly>
    </div>
</div>

<script></script>
