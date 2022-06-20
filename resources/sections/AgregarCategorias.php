<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeCategorias.php";
include_once TEMPLATES . "/Cabecera.php";
require_once VIEWS . "/CrearComponentes.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return "Añadir Categoria";
}

if ($_POST) {
    $nombre = $_POST["nombre-categoria"];
    $descripcion = $_POST["descripcion-categoria"];

    $gestor = new GestorDeCategorias($nombre, $descripcion);
    echo $gestor->agregarCategoria();

    $archivoActual = $_SERVER['PHP_SELF'];
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=$archivoActual\">";
}

?>

<body>

    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-primary">
                    Añadir una nueva categoria
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
                                    aria-describedby="nombre-categoria" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa una descripcion para la
                                categoria</label>
                            <textarea class="form-control" name="descripcion-categoria"
                                rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Añadir categoria</button>

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