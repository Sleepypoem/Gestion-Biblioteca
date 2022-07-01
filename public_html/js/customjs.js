/* ******************************************************* Funcion para mostrar contraseñas ******************************************************* */

function mostrarContra(campo, icono) {
    var campo = document.getElementById(campo);
    var icono = document.getElementById(icono);
    if (campo.type === "password") {
        campo.type = "text";
        icono.className = "bi bi-eye"
    } else {
        campo.type = "password";
        icono.className = "bi bi-eye-slash"
    }
};

/* ************************************************************************************************************************************************ */

/* **************************************************** Funcion para comparar ambas contraseñas *************************************************** */

function compararContra(contra1, contra2) {
    var contra1 = document.getElementById(contra1);
    var contra2 = document.getElementById(contra2);
    var button = document.getElementById("submit");
    if (contra1.value !== contra2.value) {
        contra2.className = "form-control is-invalid";
        contra2.setAttribute("data-toggle", "tooltip");
        contra2.setAttribute("data-placement", "right");
        contra2.setAttribute("title", "Las contraseñas no coinciden!");

        button.className = "btn btn-success disabled";
    } else {
        contra2.className = "form-control is-valid";
        contra2.setAttribute("title", "Las contraseñas coinciden");
        button.className = "btn btn-success";
    };
}

/* ************************************************************************************************************************************************ */
