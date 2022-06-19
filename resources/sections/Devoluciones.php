<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeDevoluciones.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */
function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

//despues de 3 dias aprendiendo los joins xd
function actualizarLista()
{
    $intermediario = new Intermediario();
    $sql = "SELECT prestamo.codigo_copia as codigo, libro.titulo as nombre FROM prestamo
 inner join copias on copias.codigo = prestamo.codigo_copia inner join libro on libro.isbn = copias.isbn where prestamo.estado = 1;";
    return $intermediario->ejecutarSQL($sql);
}
$listaCopias = actualizarLista();

if ($_POST) {
    $gestor = new GestorDeDevoluciones($_POST["codigo-copia"]);
    $gestor->devolver();
    $listaCopias = actualizarLista();
}
?>

<body>
    <div class="container">
        <div class="card outline-danger">
            <div class="card-header card-header text-white text-center bg-primary">
                Devolver libro
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Copias prestadas</label>
                        <div class="input-group">
                            <span class="input-group-text" id="select-test">
                                <i class="bi bi-journal-arrow-down"></i>
                            </span>
                            <select class="form-control" name="codigo-copia">
                                <?php foreach ($listaCopias as $copia) { ?>

                                <option value="<?php echo $copia["codigo"] ?>">
                                    <?php echo "copia# " . $copia["codigo"] . " - " . $copia["nombre"] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success">
                        <div class="btn-group">
                            <i class="bi bi-journal-arrow-down"> Devolver
                                libro </i>
                        </div>

                    </button>
                </form>

            </div>
            <div class="card-footer bg-primary text-muted">

            </div>
        </div>
    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>