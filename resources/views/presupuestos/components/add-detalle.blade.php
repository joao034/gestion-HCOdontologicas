<form action="{{ route('presupuestos.store') }}" method="POST">
    @csrf
    <input type="hidden" name="presupuesto_id" value="{{ $presupuesto->id }}">

    <div class="d-flex flex-wrap mt-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title fw-bold">¿Desea agregar otro tratamiento?</h6>
                <div class="input-group mb-3">
                    <!--Tratamiento-->
                    <select class="form-select form-select-md" name="tratamiento_id" required>
                        <option value="">Seleccione el tratamiento </option>
                        @foreach ($tratamientos as $tratamiento)
                            <option value="{{ $tratamiento->id }}">
                                {{ $tratamiento->nombre . ' - $ ' . $tratamiento->precio }}
                            </option>
                        @endforeach
                    </select>

                    <!--Odontologo-->
                    <select class="form-select form-select-md" name="odontologo_id" required>
                        @if (Auth::user()->role === 'admin')
                            <option value="" selected>Seleccione un odontólogo</option>
                            @foreach ($odontologos as $user)
                                <option value="{{ $user->odontologo->id }}">
                                    {{ $user->odontologo->nombres . ' ' . $user->odontologo->apellidos . ' - ' . $user->odontologo->especialidad->nombre }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ Auth::user()->odontologo->id }}" selected>
                                {{ Auth::user()->odontologo->nombres . ' ' . Auth::user()->odontologo->apellidos . ' - ' . Auth::user()->odontologo->especialidad->nombre }}
                            </option>
                        @endif
                    </select>
                    <button class="btn btn-primary" type="submit"><i class="fa-regular fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>
