$(document).ready(function () {
    $("#tratamiento_id").change(function () {
        var tratamientoId = $(this).val();
        $.ajax({
            type: "GET",
            url: "/reportes/pacientes-por-tratamiento",
            data: {
                tratamiento_id: tratamientoId,
            },
            dataType: "json",
            success: function (data) {
                console.log(data.pacientes);
                actualizarTabla(data.pacientes);
            },
            error: function (error) {
                console.error(error);
            },
        });
    });

    $("#generatePdfBtn").click(function () {
        var tratamientoId = $("#tratamiento_id").val();
        window.location.href = "/reportes/pdf/pacientes-por-tratamiento?tratamiento_id=" + tratamientoId;
    });

});

//construye y actualiza la tabla
function actualizarTabla(pacientes) {
    var tabla = '<table class="table">';
    tabla += '<thead class="bg-dark text-white">';
    tabla += "<tr>";
    tabla += '<th scope="col">Cédula</th>';
    tabla += '<th scope="col">Paciente</th>';
    tabla += '<th scope="col">Edad</th>';
    tabla += '<th scope="col">Celular</th>';
    tabla += '<th scope="col">Dirección</th>';
    tabla += "</tr>";
    tabla += "</thead>";
    tabla += "<tbody>";

    if (pacientes.length === 0) {
        tabla += "<tr>";
        tabla += '<td colspan="4" class="">No hay resultados de pacientes</td>';
        tabla += "</tr>";
    } else {
        $.each(pacientes, function (index, paciente) {
            tabla += "<tr>";
            tabla += '<td scope="row">' + paciente.cedula + "</td>";
            tabla +=
                "<td>" + paciente.nombres + " " + paciente.apellidos + "</td>";
            //calcula la edad con la fecha de nacimiento
            var fechaNacimiento = new Date(paciente.fecha_nacimiento);
            var fechaActual = new Date();
            var edad =
                fechaActual.getFullYear() - fechaNacimiento.getFullYear();
            tabla += "<td>" + edad + "</td>";
            tabla += "<td>" + paciente.celular + "</td>";
            //if (paciente.representante == null) paciente.representante = "-";
            tabla += "<td>" + paciente.direccion + "</td>";
            tabla += "<td></td>";
            tabla += "</tr>";
        });
    }

    tabla += "</tbody>";
    tabla += "</table>";

    // Actualiza el contenido de #pacientesContainer con la nueva tabla
    $("#pacientesContainer").html(tabla);
}
