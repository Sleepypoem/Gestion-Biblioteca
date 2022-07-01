<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeUsuarios.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

/* ************************************************************* Variables por defecto ************************************************************ */
$intermediario = new Intermediario();
$accion = "Agregar";
$archivoActual = $_SERVER['PHP_SELF'];
$codigo = $_SESSION["codigo"];
$nombre = $_SESSION["nombre"];
$direccion = $_SESSION["direccion"];
$telefono = $_SESSION["telefono"];
$usuario = $_SESSION["usuario"];
$contrasenia = "";
$contraseniaConfirmacion = "";
$imagen = $_SESSION["imagen"];
$rol = $_SESSION["rol"];
$rutaImg = "../../public_html/img/content/";
/* ************************************************************************************************************************************************ */
function obtenerNombrePagina()
{
    return "Usuarios";
}

if ($_GET) {
    $codigo = $_GET["cod"];
    $sql = "SELECT * FROM usuario WHERE codigo = $codigo";

    $datosDeBD = $intermediario->consultarConBD($sql)[0];
    $nombre = $datosDeBD["nombre"];
    $direccion = $datosDeBD["direccion"];
    $telefono = $datosDeBD["telefono"];
    $usuario = $datosDeBD["usuario"];
    $imagen = $datosDeBD["imagen"];
    $rol = ($datosDeBD["estado"] === 1) ? "usuario" : "bibliotecario";
}

if ($_POST) {
    $nombre = $_POST["nombre-usuario"];
    $direccion = $_POST["direccion-usuario"];
    $telefono = $_POST["telefono-usuario"];
    $usuario = $_POST["usuario-usuario"];
    $contrasenia = $_POST["contrasenia-usuario"];

    $gestor = new GestorDeUsuarios($nombre, $usuario, $contrasenia, $rol);
    $gestor->setTelefono($telefono);
    $gestor->setDireccion($direccion);

    if ($_FILES["imagen-usuario"]["error"] === 0) {
        $nombreTempImagen = $_FILES["imagen-usuario"]["tmp_name"];
        $nombreImagen = $_FILES["imagen-usuario"]["name"];

        //si una nueva imagen es pasada al editar el libro tenemos que borrar la anterior, excepto si es la de default
        if ($imagen !== "default.png") {
            file_exists($rutaImg . $imagen) ? unlink($rutaImg . $imagen) : "";
        }

        $gestor->setImagen(moverImagen($nombreTempImagen, $rutaImg, $nombreImagen));
    } else {
        $gestor->setImagen($imagen);
    }

    echo $gestor->editarUsuario($codigo);
    echo refrescarPagina(2, $archivoActual);
}

?>

<body>
    <div class="container justify-content-center">
        <div class="row">

            <div class="col-md-8">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            Editar usuario
                        </div>
                        <div class="card-body">

                            <label>Ingresa el nombre del usuario</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-person-circle"></i></span>
                                </div>

                                <input type="text" name="nombre-usuario" class="form-control"
                                    placeholder="Escribe el nombre del usuario"
                                    value="<?php echo $nombre ?>">
                            </div>

                            <label>Ingresa el numero de telefono</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-telephone-plus"></i></span>
                                </div>

                                <input type="text" name="telefono-usuario" class="form-control"
                                    placeholder="000-0000-0000" value="<?php echo $telefono ?>">
                            </div>

                            <label>Ingresa la direccion</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-house-heart"></i></span>
                                </div>

                                <input type="text" name="direccion-usuario" class="form-control"
                                    placeholder="Ingresa la direccion"
                                    value="<?php echo $direccion ?>">
                            </div>

                            <label>Ingresa el nombre de usuario o correo</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                                </div>

                                <input type="text" name="usuario-usuario" class="form-control"
                                    placeholder="Ingresa el usuario" value="<?php echo $usuario ?>">
                            </div>

                            <label class="form-label">
                                Ingresa la nueva contraseña
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-key"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control"
                                    name="contrasenia-usuario" id="contrasenia">
                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="visibilidadContrasenia"
                                        onclick="mostrarContra('contrasenia', 'visibilidadContrasenia')"></i>
                                </span>
                            </div>

                            <label class="form-label">
                                Confirma la contraseña
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-key-fill"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control"
                                    name="contrasenia-usuario-confirmacion" id="contraseniaConf"
                                    oninput="compararContra('contrasenia','contraseniaConf')">

                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="visibilidadContraseniaConf"
                                        onclick="mostrarContra('contraseniaConf', 'visibilidadContraseniaConf')"></i>
                                </span>
                            </div>

                            <button type="submit" class="btn btn-success" id="submit"><i
                                    class="bi bi-person-plus"> Editar
                                    usuario</i></button>
                        </div>
                    </div>
            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        <img class=" rounded-circle"
                            src="<?php echo (file_exists($rutaImg . $imagen)) ? $rutaImg . $imagen : $rutaImg . "default.jpg" ?>"
                            alt="Title" width="380" height="400">
                        <div class="mb-3">
                            <label class="form-label">Cambiar la foto</label>
                            <input type="file" class="form-control" name="imagen-usuario">
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <script src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/customjs.js"; ?>">

    </script>
</body>