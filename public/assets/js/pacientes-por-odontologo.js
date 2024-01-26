$(document).ready(function () {
    $("#odontologo_id_origen").change(function () {
        let odontologoId = $(this).val();
        $.ajax({
            type: "GET",
            url: "/reportes/pacientes-por-odontologo",
            data: {
                odontologo_id: odontologoId,
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
        let odontologoId = $("#odontologo_id_origen").val();
        window.open(
            "/reportes/pdf/pacientes-por-odontologo?odontologo_id_origen=" +
                odontologoId,
            "_blank"
        );
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
    tabla += '<th scope="col">Historia Clínica</th>';
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
            tabla +=
                '<td scope="row">' +
                (paciente.cedula === null ? "-" : paciente.cedula) +
                "</td>";
            tabla +=
                "<td>" + paciente.apellidos + " " + paciente.nombres + "</td>";
            //calcula la edad con la fecha de nacimiento
            let fechaNacimiento = new Date(paciente.fecha_nacimiento);
            let fechaActual = new Date();
            let edad =
                fechaActual.getFullYear() - fechaNacimiento.getFullYear();
            tabla += "<td>" + edad + " años" + "</td>";
            tabla +=
                "<td>" +
                (paciente.celular === null ? "-" : paciente.celular) +
                "</td>";
            //if (paciente.representante == null) paciente.representante = "-";
            tabla += "<td>" + paciente.direccion + "</td>";
            tabla +=
                '<td><button onclick="redirigirAHclinicas(' +
                paciente.id +
                ')" class="btn btn-secondary"><i class="fa-regular fa-pen-to-square"></i> Ver</button></td>';

            tabla += "<td></td>";
            tabla += "</tr>";
        });
    }
    
    tabla += "</tbody>";
    tabla += "</table>";

    // Actualiza el contenido de #pacientesContainer con la nueva tabla
    $("#pacientesContainer").html(tabla);
}

function redirigirAHclinicas(pacienteId) {
    window.open("/hclinicas/" + pacienteId, "_blank");
}
