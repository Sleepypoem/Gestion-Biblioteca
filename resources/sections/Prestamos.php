<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
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

$sql = "SELECT prestamo.fechaPrestamo as inicio, prestamo.fechaDevolucion as fin, usuario.nombre, libro.titulo, prestamo.estado FROM prestamo
 join usuario ON usuario.codigo = prestamo.codigoLector JOIN copias ON copias.codigo = prestamo.codigo_copia JOIN libro ON copias.isbn = libro.isbn;";
$listaPrestamos = $intermediario->ejecutarSQL($sql);

if ($_POST) {
    $gestorPrestamos = new GestorDePrestamos($_POST["codigo-lector"], 1000, $_POST["prestamos-isbn"]);
    echo $gestorPrestamos->prestar();

    $archivoActual = $_SERVER['PHP_SELF'];
    echo "<meta http-equiv=\"Refresh\" content=\"1;url=$archivoActual\">";
}

?>

<body>
    <div class="container">
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-4">
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

                                        <option value="<?php echo $libro["isbn"] ?>">
                                            <?php echo $libro["titulo"] ?></option>
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
                            <input type="hidden" class="form-control" value="prestamos"
                                name="form-id" aria-describedby="identificador-de-formulario">
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
            <!-- Fin primera columna -->
            <div class="col-md-8">
                <div class="card" style="height: 100%">
                    <div class="card-header text-center text-white bg-primary">
                        Historial de prestamos
                    </div>
                    <div class="card-body">

                        <table class="table table-striped " id="tabla-prestamos">
                            <thead class="text-center text-white bg-primary">
                                <tr>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Prestado a</th>
                                    <th>Libro</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaPrestamos as $prestamo) { ?>
                                <tr>
                                    <td scope="row"><?php echo $prestamo["inicio"]  ?></td>
                                    <td><?php echo $prestamo["fin"]  ?></td>
                                    <td><?php echo $prestamo["nombre"]  ?></td>
                                    <td><?php echo $prestamo["titulo"]  ?></td>
                                    <td>
                                        <?php if ($prestamo["estado"] == 1) {
                                                echo "<a class=\"btn disabled w-75 btn-warning\"><i class=\"bi bi-person-x\">  Sin devolver</i></a>";
                                            } else if ($prestamo["estado"] == 2) {
                                                echo "<a class=\"btn disabled w-75 btn-success\"><i class=\"bi bi-person-check\">  Devuelto</i></a>";
                                            } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer bg-primary text-muted">
                    </div>
                </div>
                <script
                    src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

                </script>

            </div>
        </div>
    </div>
</body>
<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>