<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeCategorias.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return "Añadir Categoria";
}

/* *************************************************************** Variables default ************************************************************** */
$intermediario = new Intermediario();
$encabezado = "Añadir una nueva";
$agregar = true;
$id;
/* ************************************************************************************************************************************************ */

if ($_GET) {
    $encabezado = "Editar";
    $id = $_GET["id"];
    $agregar = false;

    $sql = "SELECT * FROM `tipos-de-libros` WHERE idtipoLibro = $id";
    $categoria = $intermediario->ejecutarSQL($sql)[0];
}

if ($_POST) {

    $nombre = $_POST["nombre-categoria"];
    $descripcion = $_POST["descripcion-categoria"];

    if ($agregar) {

        $gestor = new GestorDeCategorias($nombre, $descripcion, $intermediario);
        echo $gestor->agregarCategoria();
    } else {

        $gestor = new GestorDeCategorias($nombre, $descripcion, $intermediario);
        echo $gestor->editarCategoria($id);
    }

    /* *************************************************** Refresca la pagina despues de 2 segundos *************************************************** */
    $archivoActual = $_SERVER['PHP_SELF'];
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=$archivoActual\">";
    /* ************************************************************************************************************************************************ */
}



?>

<body>

    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-primary">
                    <?php echo $encabezado ?> categoria
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Ingresa el nombre de la categoria</label>
                            <div class="input-group">
                                <span class="input-group-text" id="select-test">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <input type="text" class="form-control" name="nombre-categoria"
                                    value="<?php echo isset($categoria["nombre"]) ? $categoria["nombre"] : "" ?>"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa una descripcion para la
                                categoria</label>
                            <textarea class="form-control" name="descripcion-categoria"
                                rows="5"><?php echo isset($categoria["descripcion"]) ? $categoria["descripcion"] : "" ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <?php echo $encabezado ?> categoria
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