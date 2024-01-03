$(document).ready(function () {
    $("#year").change(function () {
        var year = $(this).val();
        $.ajax({
            type: "GET",
            url: "/reportes/total-presupuesto-por-meses",
            data: {
                year: year,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                actualizarTabla(data.resultados);
            },
            error: function (error) {
                console.error(error);
            },
        });
    });

    /* $("#generatePdfBtn").click(function () {
        var odontologoId = $("#odontologo_id").val();
        window.location.href = "/reportes/pdf/pacientes-por-odontologo?odontologo_id=" + odontologoId;
    }); */
});

//construye y actualiza la tabla
function actualizarTabla(resultados) {
    var tabla = '<table class="table">';
    tabla += '<thead class="bg-dark text-white">';
    tabla += "<tr>";
    tabla += '<th scope="col">Año</th>';
    tabla += '<th scope="col">Mes</th>';
    tabla += '<th scope="col">Monto Total</th>';
    tabla += "</tr>";
    tabla += "</thead>";
    tabla += "<tbody>";

    if (resultados.lenght == 0) {
        tabla += "<tr>";
        tabla += '<td colspan="4" class="">No hay resultados encontrados</td>';
        tabla += "</tr>";
    } else {
        $.each(resultados, function (index, resultado) {
            tabla += "<tr>";
            tabla += '<td scope="row">' + resultado.year + "</td>";
            //presentar el mes en español
            switch (resultado.month) {
                case "January":
                    resultado.month = "Enero";
                    break;
                case "February ":
                    resultado.month = "Febrero";
                    break;
                case "March":
                    resultado.month = "Marzo";
                    break;
                case "April":
                    resultado.month = "Abril";
                    break;
                case "May":
                    resultado.month = "Mayo";
                    break;
                case "June":
                    resultado.month = "Junio";
                    break;
                case "July":
                    resultado.month = "Julio";
                    break;
                case "August":
                    resultado.month = "Agosto";
                    break;
                case "September":
                    resultado.month = "Septiembre";
                    break;
                case "October":
                    resultado.month = "Octubre";
                    break;
                case "November":
                    resultado.month = "Noviembre";
                    break;
                case "December":
                    resultado.month = "Diciembre";
                    break;
            }
            tabla += "<td>" + resultado.month + "</td>";
            tabla += "<td>" + "$" + resultado.total_por_mes + "</td>";
            tabla += "</tr>";
        });
    }

    tabla += "</tbody>";
    tabla += "</table>";

    // Actualiza el contenido de #pacientesContainer con la nueva tabla
    $("#table_presupuestos").html(tabla);
}
