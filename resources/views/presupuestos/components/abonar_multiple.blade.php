<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-bold">Abonar</h5>
        <form id="formAbonos" action="{{ route('abonos.store') }}" method="post">
            @csrf
            <input type="hidden" name="detalles_check_values" id="detalles_check_values">
            <div class="table-responsive mx-4">
                <table class="table  table-bordered table-hover table-md">
                    <tbody>
                        <tr class="">
                            <td scope="col"><strong>Prestaciones seleccionadas:</strong></td>
                            <td id="total">$0,00</td>
                        </tr>
                        <tr>
                            <td><strong>Total a pagar:</strong></td>
                            <td>
                                <input class="form-control form-control-md" type="number" id="total_a_pagar"
                                    name="total_a_pagar" step="any" value="0">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary text-white float-end mx-4" onclick="submitForm()">
                <i class="fa-solid fa-money-bill"></i> Abonar
            </button>
        </form>
    </div>
</div>

<script>
    function submitForm() {
        // Obtén todos los checkboxes seleccionados
        const selectedCheckboxes = document.querySelectorAll('input[name="detalles_check[]"]:checked');
        // Crea un array para almacenar los valores seleccionados
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

        // Establece los IDs seleccionados en el campo oculto
        document.getElementById('detalles_check_values').value = selectedIds.join(',');

        // Envía el formulario
        document.getElementById('formAbonos').submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Obtén todos los elementos checkbox
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="detalles_check[]"]');
        const totalElement = document.getElementById('total');
        const total_a_pagar = document.getElementById('total_a_pagar');

        // Maneja el cambio en cada checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Calcula el nuevo total
                const total = calcularTotal();
                // Actualiza el elemento HTML con el nuevo total
                totalElement.textContent = '$' + total.toFixed(2);
                total_a_pagar.value = total.toFixed(2);
            });
        });

        function calcularTotal() {
            let total = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    // Obtiene el precio del atributo de datos
                    const precio = parseFloat(checkbox.getAttribute('data-precio'));
                    total += precio;
                }
            });
            return total;
        }
    });
</script>
