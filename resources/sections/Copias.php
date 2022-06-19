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

$intermediario = new Intermediario();
$reps = false;
$repe = false;
$codigo;
$base = $config["urls"]["baseUrl"];

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
        $sql = "UPDATE copias SET estado = 0 WHERE codigo = $codigo";
        $intermediario->ejecutarSQL($sql);
    }
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=?isbn=$isbn\">";
} else if (isset($_GET["repe"])) {

    $repe = $_GET["repe"];
    $codigo = $_GET["cod"];
    $isbn = $_GET["isbn"];


    if ($repe) {
        $sql = "UPDATE copias SET estado = 1 WHERE codigo = $codigo";
        $intermediario->ejecutarSQL($sql);
    }
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=?isbn=$isbn\">";
}

?>

<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-2">

            </div>


            <div class="col-md-8">

                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        Copias del libro <?php echo $copias[0]["titulo"]; ?>
                    </div>
                    <div class="card-body">
                        <!-- Aqui va la tabla -->
                        <table class="table table-striped" id="tabla-copias">
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