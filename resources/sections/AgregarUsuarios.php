<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeUsuarios.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

/* ************************************************************* Variables por defecto ************************************************************ */
$accion = "Agregar";
$archivoActual = $_SERVER['PHP_SELF'];
$rutaImg = "../../public_html/img/content/";
/* ************************************************************************************************************************************************ */
function obtenerNombrePagina()
{
    return "Usuarios";
}

if ($_POST) {
    $nombre = $_POST["nombre-usuario"];
    $direccion = $_POST["direccion-usuario"];
    $telefono = $_POST["telefono-usuario"];
    $usuario = $_POST["usuario-usuario"];
    $contrasenia = $_POST["contrasenia-usuario"];
    $rol = $_POST["rol"];

    $gestor = new GestorDeUsuarios($nombre, $usuario, $contrasenia, $rol);
    $gestor->setTelefono($telefono);
    $gestor->setDireccion($direccion);

    if (isset($_FILES["imagen-usuario"])) {
        $nombreTempImagen = $_FILES["imagen-usuario"]["tmp_name"];
        $nombreImagen = $_FILES["imagen-usuario"]["name"];
        $gestor->setImagen(moverImagen($nombreTempImagen, $rutaImg, $nombreImagen));
    } else {
        $gestor->setImagen("default.png");
    }

    echo $gestor->registrarUsuario();
    echo refrescarPagina(2, $archivoActual);
}

?>

<body>
    <div class="container justify-content-center">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-center text-white">
                        <?php echo $accion ?> usuario
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="formulario" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">¿Que rol tendra el usuario?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="bi bi-patch-question"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" name="rol">
                                        <option value="usuario">Usuario</option>
                                        <option value="bibliotecario">Bibliotecario</option>
                                    </select>
                                </div>
                            </div>

                            <label>Ingresa el nombre del usuario</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-person-circle"></i></span>
                                </div>

                                <input type="text" name="nombre-usuario" class="form-control"
                                    placeholder="Escribe el nombre del usuario">
                            </div>

                            <label>Ingresa el numero de telefono</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-telephone-plus"></i></span>
                                </div>

                                <input type="text" name="telefono-usuario" class="form-control"
                                    placeholder="000-0000-0000">
                            </div>

                            <label>Ingresa la direccion</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-house-heart"></i></span>
                                </div>

                                <input type="text" name="direccion-usuario" class="form-control"
                                    placeholder="Ingresa la direccion">
                            </div>

                            <label>Ingresa el nombre de usuario o correo</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                                </div>

                                <input type="text" name="usuario-usuario" class="form-control"
                                    placeholder="Ingresa el usuario">
                            </div>

                            <label class="form-label">
                                Ingresa la contraseña
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


                            <div class="mb-3">
                                <label class="form-label">Ingresa una imagen</label>
                                <input type="file" class="form-control" name="imagen-usuario">
                            </div>

                            <button type="submit" class="btn btn-success" id="submit"><i
                                    class="bi bi-person-plus"> Agregar
                                    usuario</i></button>
                        </form>
                    </div>
                    <div class="card-footer bg-primary text-muted">

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/customjs.js"; ?>">

    </script>
</body>