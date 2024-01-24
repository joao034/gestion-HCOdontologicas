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
    tabla += '<th scope="col">Total Presupuestos</th>';
    tabla += '<th scope="col">Total Abonos</th>';
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
            tabla += '<td scope="row">' + resultado.anio + "</td>";
            //presentar el mes en español
            switch (resultado.mes) {
                case "January":
                    resultado.mes = "Enero";
                    break;
                case "February ":
                    resultado.mes = "Febrero";
                    break;
                case "March":
                    resultado.mes = "Marzo";
                    break;
                case "April":
                    resultado.mes = "Abril";
                    break;
                case "May":
                    resultado.mes = "Mayo";
                    break;
                case "June":
                    resultado.mes = "Junio";
                    break;
                case "July":
                    resultado.mes = "Julio";
                    break;
                case "August":
                    resultado.mes = "Agosto";
                    break;
                case "September":
                    resultado.mes = "Septiembre";
                    break;
                case "October":
                    resultado.mes = "Octubre";
                    break;
                case "November":
                    resultado.mes = "Noviembre";
                    break;
                case "December":
                    resultado.mes = "Diciembre";
                    break;
            }
            tabla += "<td>" + resultado.mes + "</td>";
            tabla += "<td>" + "$" + resultado.total_presupuestos + "</td>";
            tabla += "<td>" + "$" + resultado.total_abonos + "</td>";
            tabla += "</tr>";
        });
    }

    tabla += "</tbody>";
    tabla += "</table>";

    // Actualiza el contenido de #pacientesContainer con la nueva tabla
    $("#table_presupuestos").html(tabla);
}
