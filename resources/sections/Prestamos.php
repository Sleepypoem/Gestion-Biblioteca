<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Organizacion-prueba/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDePrestamos.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}
/* ****************************************************************** Instancias ****************************************************************** */
$intermediario = new Intermediario();
/* ************************************************************************************************************************************************ */
$sql = "SELECT * FROM v_libros WHERE copias > 1";
$listaLibros = $intermediario->ejecutarSQL($sql);
$sql = "SELECT * FROM usuario WHERE estado = 1";
$listaUsuarios = $intermediario->ejecutarSQL($sql);

if ($_POST) {
    $gestorPrestamos = new GestorDePrestamos($_POST["codigo-lector"], 1000, $_POST["prestamos-isbn"]);
    echo $gestorPrestamos->prestar();
}

?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header card-header text-white text-center bg-primary">
                Prestar libro
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Libros disponibles</label>
                        <div class="input-group">
                            <span class="input-group-text" id="select-test">
                                <i class="bi bi-journal-arrow-up"></i>
                            </span>
                            <select class="form-control" name="prestamos-isbn">
                                <?php foreach ($listaLibros as $libro) { ?>

                                <option value="<?php echo $libro["isbn"] ?>"><?php echo $libro["titulo"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Usuarios registrados</label>
                        <div class="input-group">
                            <span class="input-group-text" id="select-test">
                                <i class="bi bi-person-circle"></i>
                            </span>
                            <select class="form-control" name="codigo-lector">
                                <?php foreach ($listaUsuarios as $usuarios) { ?>

                                <option value="<?php echo $usuarios["codigo"] ?>">
                                    <?php echo $usuarios["nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" value="prestamos" name="form-id"
                        aria-describedby="identificador-de-formulario">
                    <br>
                    <button type="submit" class="btn btn-success">
                        <div class="btn-group">
                            <i class="bi bi-journal-arrow-up"> Prestar
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