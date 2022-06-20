<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeAutores.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

/* ************************************************************* Variables por defecto ************************************************************ */
$intermediario = new Intermediario();
//variables para marcar el iicio t final de las reparaciones
$reps = false;
$repe = false;
$codigo;
$base = $config["urls"]["baseUrl"];
/* ************************************************************************************************************************************************ */

//A la seccion de copias por el momento solo se puede acceder desde el catalogo asi que si no hay un $_GET del isbn se redirecciona al inicio
if (isset($_GET["isbn"])) {

    $isbn = $_GET["isbn"];


    $sql = "SELECT copias.codigo, copias.isbn, copias.estado, libro.titulo FROM copias INNER JOIN libro ON copias.isbn = libro.isbn WHERE copias.isbn = '$isbn';";
    $copias = $intermediario->ejecutarSQL($sql);
} else {

    echo "<meta http-equiv=\"Refresh\" content=\"0;url=$base\">";
}

if (isset($_GET["reps"])) {

    $reps = $_GET["reps"];
    $codigo = $_GET["cod"];
    $isbn = $_GET["isbn"];

    if ($reps) {
        //aqui se pone a la copia el estado 0 que significa que esta en reparacion y no esta disponible para prestar
        $sql = "UPDATE copias SET estado = 0 WHERE codigo = $codigo";
        $intermediario->ejecutarSQL($sql);
    }

    /* ************************** Refresca la pagina inmediatamente para que se vean los cambios en los estados de las copias ************************* */
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=?isbn=$isbn\">";
    /* ************************************************************************************************************************************************ */
} else if (isset($_GET["repe"])) {

    $repe = $_GET["repe"];
    $codigo = $_GET["cod"];
    $isbn = $_GET["isbn"];


    if ($repe) {
        //aqui se le pone 1 para indicar que ya termino la reparacion y vuelve a estar disponible
        $sql = "UPDATE copias SET estado = 1 WHERE codigo = $codigo";
        $intermediario->ejecutarSQL($sql);
    }
    /* ************************** Refresca la pagina inmediatamente para que se vean los cambios en los estados de las copias ************************* */
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=?isbn=$isbn\">";
    /* ************************************************************************************************************************************************ */
}

?>

<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-2">

            </div>

            <!-- Aqui nos aseguramos que no se vean errores antes de redirigir al inicio -->
            <?php if (isset($_GET["isbn"])) { ?>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        Copias del libro <?php echo $copias[0]["titulo"]; ?>
                    </div>
                    <div class="card-body">
                        <!-- Aqui va la tabla -->
                        <table class="table table-striped table-primary" id="tabla-copias">
                            <thead class="text-center">
                                <tr>
                                    <th>Código</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php

                                    foreach ($copias as $copia) {
                                    ?>
                                <tr>
                                    <td><?php echo $copia["codigo"] ?> </td>
                                    <td>
                                        <?php
                                                if ($copia["estado"] == 1) {
                                                    echo "<a class=\"btn disabled w-75 btn-success\"><i class=\"bi bi-check-circle\">  Disponible</i></a>";
                                                } else if ($copia["estado"] == 2) {
                                                    echo "<a class=\"btn disabled w-75 btn-warning\"><i class=\"bi bi-person-check\">  Prestada</i></a>";
                                                } else {
                                                    echo "<a class=\"btn disabled w-75 btn-danger\"><i class=\"bi bi-bandaid\"></i>En reparacion</a>";
                                                }

                                                ?>
                                    </td>
                                    <td>
                                        <?php if ($copia["estado"] == 0) {
                                                    echo "<a class=\"btn w-75 btn-info\" href=\"?repe=true&cod=" . $copia["codigo"] . "&isbn=" . $copia["isbn"] . "\"><i class=\"bi bi-bandaid-fill\"> Terminar reparacion </i></a>";
                                                } else if ($copia["estado"] == 1) {
                                                    echo "<a class=\"btn w-75 btn-info\" href=\"?reps=true&cod=" . $copia["codigo"] . "&isbn=" . $copia["isbn"] . "\"><i class=\"bi bi-bandaid-fill\"> Mandar a reparar </i></a>";
                                                } else if ($copia["estado"] == 2) {
                                                    echo "<a class=\"btn w-75 btn-info\" href=\"$base/resources/sections/Devoluciones.php\"><i class=\"bi bi-arrow-down-circle\"> Devolver </i></a>";
                                                } ?>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-primary text-muted">
                        <script
                            src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

                        </script>
                    </div>
                </div>
            </div>

            <?php } ?>

            <div class="col-md-2">

            </div>

        </div>

    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>