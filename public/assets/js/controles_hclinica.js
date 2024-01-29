$(document).ready(function () {
    // Obtener los elementos necesarios
    const fechaInput = $("#fecha_nacimiento");
    const edadInput = $("#edad");
    const representanteDiv = $("#representanteDiv");

    // Obtener el valor almacenado en localStorage para la visibilidad del representante
    const representanteVisible = localStorage.getItem("representanteVisible");

    function calcularEdad(nacimiento) {
        const fechaNacimiento = new Date(nacimiento);
        const fechaActual = new Date();
        let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

        const mesActual = fechaActual.getMonth() + 1;
        const mesNacimiento = fechaNacimiento.getMonth() + 1;

        if (
            mesNacimiento > mesActual ||
            (mesNacimiento === mesActual &&
                fechaNacimiento.getDate() > fechaActual.getDate())
        ) {
            edad--;
        }
        return edad;
    }

    function controlarVisibilidadRepresentante() {
        const edad = parseInt(edadInput.val());
        if (edad < 12) {
            representanteDiv.show();
        } else {
            representanteDiv.hide();
        }

        // Almacenar el estado actual en localStorage
        localStorage.setItem(
            "representanteVisible",
            representanteDiv.is(":visible")
        );
    }

    // Evento que se dispara al cambiar el valor del input de fecha
    fechaInput.on("change", function () {
        // Obtener el valor de la fecha de nacimiento
        const fechaNacimiento = fechaInput.val();

        // Calcular la edad y actualizar el input correspondiente
        const edad = calcularEdad(fechaNacimiento);
        edadInput.val(edad);

        // Controlar la visibilidad del div del representante según la edad calculada
        controlarVisibilidadRepresentante();
    });

    // Restaurar el estado del div de representante al cargar la página
    if (representanteVisible === "true") {
        representanteDiv.show();
    } else {
        representanteDiv.hide();
    }

    // Controlar la visibilidad del input semanas de embarazo según la respuesta de embarazada
    $('input[name="embarazada"]').on("change", function () {
        const embarazada = $(this).val();
        if (embarazada === "0") {
            $("#embarazada input").show();
        } else {
            $("#embarazada input").hide();
        }
    });

    /* let cedulaInput = document.getElementById('cedula');
            apply_input_filter(cedulaInput);
     */
    let celularInput = document.getElementById("celular");
    apply_input_filter(celularInput);

    let telefonoInput = document.getElementById("telefono");
    apply_input_filter(telefonoInput);

    function apply_input_filter(input) {
        input.addEventListener("input", function () {
            // Filtrar y mantener solo los dígitos
            const filteredValue = this.value.replace(/\D/g, "");
            this.value = filteredValue;
        });
    }
});
