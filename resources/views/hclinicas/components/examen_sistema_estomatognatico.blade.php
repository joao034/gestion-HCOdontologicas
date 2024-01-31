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
                        <input class="form-check-input" type="checkbox" id="checkbox{{ $key }}" name="partes_sistema[]"
                            value="{{ $parte }}">
                        <label class="form-check-label"
                            for="checkbox{{ $key }}">{{ $parte }}</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-floating mt-2">
            <textarea class="form-control" id="floatingTextarea2" name="observaciones"></textarea>
            <label for="floatingTextarea2" class="fw-bold">Observaciones</label>
        </div>
    </div>
</div>
