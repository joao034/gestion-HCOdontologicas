<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title fw-bold">G. EXAMEN DEL SISTEMA ESTOMATOGNÁTICO</h5>
        <hr>
        @php
            $partes_sistema_estomatognatico = [
                'labios' => '1. Labios',
                'mejillas' => '2. Mejillas',
                'maxilar superior' => '3. Maxilar superior',
                'maxilar inferior' => '4. Maxilar inferior',
                'lengua' => '5. Lengua',
                'paladar' => '6. Paladar',
                'piso' => '7. Piso',
                'carrillos' => '8. Carrillos',
                'glandulas salivales' => '9. Glándulas salivales',
                'oro faringe' => '10. Oro faringe',
                'A.T.M' => '11. A.T.M',
                'ganglios' => '12. Ganglios',
            ];
        @endphp
        <div class="row">
            @foreach ($partes_sistema_estomatognatico as $key => $parte)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input border-primary" type="checkbox" id="checkbox{{ $key }}"
                            name="partes_sistema[]" value="{{ $key }}"
                            {{ ($modo == 'show' || $modo == 'edit') && $hClinica->consulta?->retornar_partes_sistema_checkeadas($key) == true ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox{{ $key }}">{{ $parte }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-floating mt-2">
            <textarea class="form-control" id="observaciones_examen" name="observaciones_examen"
                {{ $modo == 'show' ? 'readonly' : '' }} required>{{ $modo == 'show' || $modo == 'edit' ? $hClinica->consulta?->observaciones_examen : old('observaciones_examen') }}</textarea>
            <label for="observaciones_examen" class="fw-bold fs-5">Observaciones <span class="text-danger"> * <span class="info_extra fs-6">(En caso de presentar patología anotar "Sin patología aparente")</span></span></label>
        </div>
    </div>
</div>
