<div class="modal fade" tabindex="-1" id="editarDetalle{{ $detalle->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Editar detalle del odontograma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('detalleOdontogramas.update', $detalle->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                
                    <!--Estado-->
                    <div class="row">
                        <label for="" class="form-label fw-bold">Estado</label>
                        <div class="mb-3">
                            <select class="form-select form-select-md" autofocus name="estado" id="estado" required
                                autofocus>
                                <option value="necesario" {{ $detalle->estado === 'necesario' ? 'selected' : '' }}>
                                    Pendiente</option>
                                <option value="realizado" {{ $detalle->estado === 'realizado' ? 'selected' : '' }}>
                                    Realizado</option>
                            </select>
                        </div>
                    </div>

                    <!--Tratamiento-->
                    <div class="row">
                        <label for="" class="form-label fw-bold">Tratamiento</label>
                        <div class="mb-3">
                            <select class="form-select form-select-md" autofocus name="tratamiento_id"
                                required readonly>
                                <option value="{{ $detalle->tratamiento_id }}">
                                    {{ $detalle->tratamiento->nombre }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!--Odontologos-->
                    <div class="row">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Odontólogo</label>
                            <select required class="form-select form-select-md" name="odontologo_id" id="">
                                @if (Auth::user()->role === 'admin')
                                    <option selected>Seleccione un odontólogo</option>
                                    @foreach ($odontologos as $user)
                                        <option value="{{ $user->odontologo->id }}"
                                            {{ $user->odontologo->id === $detalle->odontologo_id ? 'selected' : '' }}>
                                            {{ $user->odontologo->nombres . ' ' . $user->odontologo->apellidos . ' - ' . $user->odontologo->get_nombres_especialidades() }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="{{ Auth::user()->odontologo->id }}" selected>
                                        {{ Auth::user()->odontologo->nombres . ' ' . Auth::user()->odontologo->apellidos . ' - ' . Auth::user()->odontologo->get_nombres_especialidades() }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!--Observacion-->
                    <div class="row">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Prescripción</label>
                            <input type="text" class="form-control" name="observacion" id=""
                                aria-describedby="helpId" placeholder="Escriba alguna prescripción"
                                value="{{ $detalle->observacion }}">
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
</div>