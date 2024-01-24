<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-bold">Abonar</h5>
        <form id="formAbonos" action="{{ route('abonos.store') }}" method="post">
            @csrf
            <input type="hidden" name="detalles_check_values" id="detalles_check_values">
            <div class="table-responsive mx-4">
                <table class="table  table-bordered table-hover table-md" id="tabla_abonos">
                    <thead>
                        <tr>
                            <th scope="col">Tratamiento</th>
                            <th scope="col">Saldo</th>
                        </tr>
                    <tbody id="tbody">
                        <tr class="">
                            <td scope="col"><strong>Prestaciones seleccionadas:</strong></td>
                            <td id="total">$0.00</td>
                        </tr>
                        {{-- <tr>
                            <td><strong>Total a pagar:</strong></td>
                            <td>
                                <input class="form-control form-control-md" type="number" id="total_a_pagar"
                                    name="total_a_pagar" step="any" value="0">
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-primary text-white float-end mx-4" data-bs-toggle="modal"
            data-bs-target="#abonar_multiple">
                <i class="fa-solid fa-money-bill"></i> Abonar
            </button>
        </form>
    </div>
</div>

<!--Modal-->
<div class="modal" id="abonar_multiple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Confirmar Abono</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                ¿Desea confirmar el abono ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="submitForm()">Confirmar</button>
            </div>

        </div>
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
        const tabla_abonos = document.getElementById('tabla_abonos');
        const tableBody = document.getElementById('tbody');

        // Maneja el cambio en cada checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Calcula el nuevo total
                const total = calcularTotal();
                // Actualiza el elemento HTML con el nuevo total
                totalElement.textContent = '$' + total.toFixed(2);
                total_a_pagar.value = total.toFixed(2);

                const tratamiento = checkbox.closest('tr').querySelector('td:nth-child(2)')
                    .textContent;
                const saldo = checkbox.closest('tr').querySelector('td:nth-child(8)')
                    .textContent;

                /*  if (checkbox.checked) {
                     const fila = this.parentNode.parentNode;
                     const tratamiento = fila.querySelector('td:nth-child(2)').textContent;
                     const saldo = fila.querySelector('td:nth-child(8)').textContent;
                     insertarFila(tratamiento, saldo);
                     insertarTotal(total);
                 } else {
                     eliminarFilaDetalle();
                 } */

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

        function insertarFila(tratamiento, saldo) {
            const newRow = tabla_abonos.insertRow();
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            cell1.textContent = tratamiento;
            cell2.textContent = saldo;
        }

        function eliminarFilaDetalle(index) {
            const rowCount = tabla_abonos.rows.length;
            if (rowCount <= 1) {
                alert('No se puede eliminar el encabezado');
            } else {
                tabla_abonos.deleteRow(rowCount - 2);
                //eliminar ultima fila
                //tabla_abonos.deleteRow(rowCount - 1);
                //desocultar la fila con index rowCount - 2
                console.log(tabla_abonos.rows[rowCount - 1])
                //tabla_abonos.rows[rowCount - 1].style.display = 'table-row';
            }
        }

        /* function insertarTotal(total) {
            const rowCount = tabla_abonos.rows.length;
            if(rowCount > 1){
                const newRow = tabla_abonos.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                cell1.textContent = 'Prestaciones selecionadas:';
                cell2.textContent = '$' + total;
                 cell2.innerHTML = '<input class="form-control form-control-md" type="number" id="total_a_pagar" name="total_a_pagar" step="any" value="'+total+'">';
            }
        } */

        //insertar total a pagar cada vez que se selecciona un checkbox y elimnar el total anterior para solo tner una fila de total que se ubique al final de la tabla
        function insertarTotal(total) {
            const rowCount = tabla_abonos.rows.length;
            if (rowCount > 1) {
                const newRow = tabla_abonos.insertRow();
                //agregar id a la fila para poder eliminarla
                newRow.id = 'total_a_pagar';
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                cell1.textContent = 'Total a pagar:';
                cell2.innerHTML =
                    '<input class="form-control form-control-md" type="number" id="total_a_pagar" name="total_a_pagar" step="any" value="' +
                    total + '">';
                //tabla_abonos.deleteRow(rowCount - 2);
                //ocultar la fila con index rowCount - 2
                tabla_abonos.rows[rowCount - 2].style.display = 'none';
            }
        }

        function actualizarTotal(total) {
            let total_a_pagar = document.getElementById('total_a_pagar');

            //actualizar el total en la celda 1 de la fila total_a_pagar
            total_a_pagar.parentNode.parentNode.cells[1].innerHTML =
                '<input class="form-control form-control-md" type="number" id="total_a_pagar" name="total_a_pagar" step="any" value="' +
                total + '">';
        }



    });
</script>
