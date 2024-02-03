<div class="d-flex">
    <div class="form-floating">
        @if ($modo == 'show')
            <input type="text" class="form-control" id="floatingInputValue"
                value="{{ $odontograma?->indice_cpo_cpe?->tipo }}" readonly>
            <label for="floatingInputValue" class="fw-bold">Tipo</label>
        @else
            <select class="form-select" id="floatingSelect" name="tipo" aria-label="Floating label select example"
                required>
                <option selected value="">Seleccione un tipo</option>
                <option value="D" {{ $odontograma?->indice_cpo_cpe?->tipo == 'D' ? 'selected' : '' }}>D
                </option>
                <option value="d" {{ $odontograma?->indice_cpo_cpe?->tipo == 'd' ? 'selected' : '' }}>d
                </option>
            </select>
            <label for="floatingSelect">Tipo <span class="text-danger">*</span></label>
        @endif

    </div>

    <div class="form-floating">
        <input type="number" class="form-control" id="caries" name="caries" required
            value="{{ $odontograma?->indice_cpo_cpe?->caries }}" {{ $modo == 'show' ? 'readonly' : '' }}>
        <label for="caries" class="fw-bold">Caries (C/c) <span class="text-danger">*</span></label>
    </div>


    <div class="form-floating">
        <input type="number" class="form-control" id="perdidas" name="perdidas" required
            value="{{ $odontograma?->indice_cpo_cpe?->perdidas }}" {{ $modo == 'show' ? 'readonly' : '' }}>
        <label for="perdidas" class="fw-bold">Pérdidas/Extracciones (P/e) <span class="text-danger">*</span></label>
    </div>


    <div class="form-floating">
        <input type="number" class="form-control" id="obturadas" name="obturadas" required
            value="{{ $odontograma?->indice_cpo_cpe?->obturadas }}" {{ $modo == 'show' ? 'readonly' : '' }}>
        <label for="obturadas" class="fw-bold">Obturadas (O/o) <span class="text-danger">*</span></label>
    </div>


    <div class="form-floating">
        <input type="number" class="form-control" id="total" name="total" readonly>
        <label for="total" class="fw-bold">Total </label>
    </div>
</div>


<script>
    const caries = document.getElementById('caries');
    const perdidas = document.getElementById('perdidas');
    const obturadas = document.getElementById('obturadas');
    const total = document.getElementById('total');

    caries.addEventListener('input', function() {
        total.value = parseInt(caries.value) + parseInt(perdidas.value) + parseInt(obturadas.value);
    });

    perdidas.addEventListener('input', function() {
        total.value = parseInt(caries.value) + parseInt(perdidas.value) + parseInt(obturadas.value);
    });

    obturadas.addEventListener('input', function() {
        total.value = parseInt(caries.value) + parseInt(perdidas.value) + parseInt(obturadas.value);
    });
    total.value = parseInt(caries.value) + parseInt(perdidas.value) + parseInt(obturadas.value);
</script>
