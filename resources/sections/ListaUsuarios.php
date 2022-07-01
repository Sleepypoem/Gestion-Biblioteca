<?php
/* ***************************************************************** Dependencias ***************************************************************** */

use function PHPUnit\Framework\fileExists;

include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

/* ************************************************************* Variables por defecto ************************************************************ */
$intermediario = new Intermediario();
$listaDeUsuarios = $intermediario->obtenerDeBD("usuario");
$rutaImg = "../../public_html/img/content/";
/* ************************************************************************************************************************************************ */

/* ************************************************************* Badges para los roles ************************************************************ */
$badgeAdministrador = <<< _BOTON
    <a class="btn disabled btn-success" style="width: 250px;">
        <i class="bi bi-person-workspace">
            Administrador
        </i>
    </a>
_BOTON;

$badgeUsuario = <<< _BOTON
    <a class="btn disabled btn-primary" style="width: 250px;">
        <i class="bi bi-person-circle">
            Usuario
        </i>
    </a>
_BOTON;

$badgebibliotecario = <<< _BOTON
    <a class="btn disabled btn-info" style="width: 250px;">
        <i class="bi bi-person-badge">
            Bibliotecario
        </i>
    </a>
_BOTON;
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    "Usuarios";
}

?>


<h1 class="text-center pb-2">Lista de usuarios</h1>

<body>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white text-center bg-primary">

                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-primary" id="tabla-usuarios">
                            <thead class="text-center">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Usuario</th>
                                    <th>Imagen</th>
                                    <th>Rol</th>
                                    <?php if ($_SESSION["rol"] === "administrador") { ?>
                                    <th>Acciones</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaDeUsuarios as $usuario) { ?>
                                <tr>
                                    <td><?php echo $usuario["codigo"] ?></td>
                                    <td><?php echo $usuario["nombre"] ?></td>
                                    <td><?php echo $usuario["telefono"] ?></td>
                                    <td><?php echo $usuario["direccion"] ?></td>
                                    <td><?php echo $usuario["usuario"] ?></td>
                                    <td>
                                        <img src="<?php echo (file_exists($rutaImg . $usuario["imagen"])) ? $rutaImg . $usuario["imagen"] : $rutaImg . "default.jpg" ?>"
                                            alt="Foto del usuario" class="img-thumbnail"
                                            width="85px" height="85px">
                                    </td>
                                    <td>
                                        <!--Dependiendo de su rol, tendra una badge diferente -->
                                        <?php if ($usuario["estado"] == 3) {
                                                echo $badgeAdministrador;
                                            } elseif ($usuario["estado"] == 1) {
                                                echo $badgeUsuario;
                                            } else {
                                                echo $badgebibliotecario;
                                            } ?>
                                    </td>
                                    <!--solo podra editar usuarios si es el administrador -->
                                    <?php if ($_SESSION["rol"] === "administrador") { ?>
                                    <td>
                                        <a name="editar-usuario" class="btn btn-warning"
                                            href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/EditarUsuarios.php?cod=" . $usuario["codigo"]; ?>">
                                                    Editar
                                                </a>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-primary text-muted">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

    </script>
</body>