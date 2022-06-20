<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
include_once TEMPLATES . "/Cabecera.php";
require_once CONTROLLERS . "/Intermediario.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return "Inicio";
}

$intermediario = new Intermediario();

$usuarios = count($intermediario->obtenerDeBD("usuario"));
$libros = count($intermediario->obtenerDeBD("libro"));
$autores = count($intermediario->obtenerDeBD("autor"));
$prestamos = count($intermediario->obtenerDeBD("prestamo"));
$devoluciones = count($intermediario->obtenerDeBD("devolucion"));


?>

<h1 class="display-4 text-center">Bienvenido al sistema, administrador.</h1>
<br>

<body>
    <div class="container">
        <div class="row">

            <div class="col-sm-4">

                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        <?php echo $usuarios ?>
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Usuarios totales</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="card ">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-person-video2" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        1
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Administradores</strong>
                    </div>

                </div>

            </div>

            <div class="col-sm-4">

                <div class="card ">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-book" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        <?php echo $libros ?>
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Libros</strong>
                    </div>
                </div>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">

                <div class="card ">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-arrow-up-circle-fill"
                            style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        <?php echo $prestamos ?>
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Préstamos</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="card ">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-arrow-down-circle-fill"
                            style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        <?php echo $devoluciones ?>
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Devoluciones</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="card ">
                    <div class="card-header text-center bg-primary">
                        <i class="bi bi-cash-coin" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <div class="card-body card-body-font text-white text-center bg-success">
                        0
                    </div>
                    <div class="card-footer fs-2 text-white text-center bg-primary">
                        <strong>Multas</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>