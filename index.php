<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
include_once TEMPLATES . "/CabeceraLogin.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once VIEWS . "/CrearAlertas.php";
/* ************************************************************************************************************************************************ */

/* ******************************************************************* Variables ****************************************************************** */
$intermediario = new Intermediario();
$alertas = new CrearAlertas();
/* ************************************************************************************************************************************************ */
if ($_POST) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];

    $sql = "SELECT * FROM v_bibliotecarios WHERE usuario = '$usuario' ";
    $datosDeBD = $intermediario->consultarConBD($sql);
    $contraseniaBD = ($datosDeBD !== []) ? $intermediario->consultarConBD($sql)[0]["password"] : 0;

    if (password_verify($contrasenia, $contraseniaBD)) {
        session_start();
        $_SESSION["codigo"] = $datosDeBD[0]["codigo"];
        $_SESSION["nombre"] = $datosDeBD[0]["nombre"];
        $_SESSION["direccion"] = $datosDeBD[0]["direccion"];
        $_SESSION["telefono"] = $datosDeBD[0]["telefono"];
        $_SESSION["imagen"] = $datosDeBD[0]["imagen"];

        header("location:home.php");
    } else {
        echo "<br>";
        echo $alertas->crearAlertaFallo("Error, usuario o contraseña no valido.");
        header("refresh:2");
    }
}
?>

<h1 class="text-dark text-center mt-5">Ingresar al sistema</h1>

<div class="container pr-3 pl-3 mt-5">
    <div class="card">
        <div class="card-header text-white text-center bg-dark">
            <img src="<?php echo $config["paths"]["images"]["content"] . "/portada.png" ?>"
                class="card-img" alt="Imagen de portada" height="400">

        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">
                        Ingresa tu usuario
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-person-circle"></i>
                            </span>
                        </div>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <small id="helpId" class="form-text text-muted">
                        Si no cuentas con un usuario comunicate con el administrador.
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Ingresa tu contraseña
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="contrasenia"
                            id="contrasenia" />
                        <span class="input-group-text">
                            <i class="bi bi-eye-slash" id="visibilidadContrasenia"></i>
                        </span>
                    </div>
                </div>
        </div>
        <div class="text-center ">
            <button type="submit" class="btn btn-success">Ingresar</button>
        </div>
        <br>
        </form>
    </div>
    <div class="card-footer text-muted bg-dark">
    </div>
</div>
</div>

<script>
//tomamos el icono y el campo de la contraseñapor su id
const visibilidadContrasenia = document.querySelector("#visibilidadContrasenia");
const contrasenia = document.querySelector("#contrasenia");

//añadimos un escuchador para saber cuando se hace click en el icono
visibilidadContrasenia.addEventListener("click", function() {
    // cambiamos el atributo del campo de contraseña de "password" a "texto" para hacerla visible
    const type = contrasenia.getAttribute("type") === "password" ? "text" : "password";
    contrasenia.setAttribute("type", type);

    // cambiamos tambien el icono
    this.classList.toggle("bi-eye");
});
</script>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>