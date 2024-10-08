<div class="mb-3">
    <label for="" class="form-label fw-bold">Odontólogo</label>
    <select required class="form-select form-select-md" name="odontologo_id" id="">
        @if (Auth::user()->role === 'admin')
            <option value="" selected>Seleccione un odontólogo</option>
            @foreach ($odontologos as $user)
                <option value="{{ $user->odontologo->id }}">
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
