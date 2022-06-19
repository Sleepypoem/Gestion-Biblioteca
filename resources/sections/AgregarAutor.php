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

/* ************************************************************ Variables para la tabla *********************************************************** */
$elementosPorPagina = 7;
$inicio = 0;
$fin = $elementosPorPagina;
/* ************************************************************************************************************************************************ */

/* *************************************************************** Contar elementos *************************************************************** */
$sql = "SELECT COUNT(0) as autores FROM `autor`;";
$cantidadDeAutores = $intermediario->ejecutarSQL($sql)[0]["autores"];
/* ************************************************************************************************************************************************ */

$rutaImg = "../../public_html/img/content/";
$encabezado = "Agregar";
$id;


function  moverImagen($nombreTemporal, $ruta, $nombreImagen)
{
    $fechaDeHoy = new DateTime();
    $img = "img_" . $fechaDeHoy->getTimestamp() . "_" . $nombreImagen;
    move_uploaded_file($nombreTemporal, $ruta . "/" . $img);

    return $img;
}

$sql = "SELECT * FROM `autor` ;";
$listaAutores = $intermediario->ejecutarSQL($sql);

if ($_GET) {

    $encabezado = $_GET["enc"];
    $nombre = $_GET["name"];
    $fechaNacimiento = $_GET["fecha"];
    $imagen = $_GET["img"];
    $id = $_GET["id"];
}

if ($_POST) {
    if ($_POST["formulario-id"] == "Agregar") {
        $gestor = new GestorDeAutores($_POST["nombre-autor"], $_POST["fecha-nacimiento"]);
        if (isset($_FILES["autor-imagen"])) {
            $gestor->setImagen(moverImagen($_FILES["autor-imagen"]["tmp_name"], $rutaImg, $_FILES["autor-imagen"]["name"]));
        } else {
            $gestor->setImagen($rutaImg . "/default.png");
        }

        echo $gestor->agregarAutor();
    } else {
        $gestor = new GestorDeAutores($_POST["nombre-autor"], $_POST["fecha-nacimiento"]);
        if ($_FILES["autor-imagen"]["name"]) {
            $gestor->setImagen(moverImagen($_FILES["autor-imagen"]["tmp_name"], $rutaImg, $_FILES["autor-imagen"]["name"]));
        } else {
            $gestor->setImagen($imagen);
        }
        echo $gestor->editarAutor($id);
    }
    $archivoActual = $_SERVER['PHP_SELF'];
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=$archivoActual\">";
}


?>

<body>
    <div class="container">
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-3">
                <div class="card" style="height: 100%">
                    <div class="card-header text-center text-white bg-primary">
                        <?php echo $encabezado ?> autor
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label>Ingresa el nombre del autor</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="bi bi-person-lines-fill"></i></span>
                                </div>

                                <input type="text" name="nombre-autor" class="form-control"
                                    placeholder="Escribe el nombre del autor"
                                    value="<?php echo (isset($nombre)) ? $nombre : "" ?>">
                            </div>
                            <label>Ingresa la fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha-nacimiento"
                                value="<?php echo (isset($fechaNacimiento)) ? $fechaNacimiento : "" ?>">
                            <br>
                            <div class="mb-3">
                                <labelclass="form-label">
                                    <?php echo (isset($fechaNacimiento)) ? "Imagen actual: " . $imagen : "Ingresa una imagen del autor" ?></label>
                                    <input type="file" class="form-control" name="autor-imagen">
                            </div>

                            <input type="hidden" name="formulario-id"
                                value="<?php echo $encabezado ?>">

                            <button type="submit" class="btn btn-success">
                                <div class="btn-group">
                                    <i class="bi bi-person-lines-fill"> <?php echo $encabezado ?>
                                        Autor </i>
                                </div>
                            </button>
                        </form>

                    </div>
                    <div class="card-footer text-muted bg-primary">
                    </div>
                </div>

            </div>

            <!-- Segunda columna -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Lista de Autores
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-primary" id="tabla-autores"
                            style="width:100%">
                            <thead class=" center-text">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaAutores as $autor) { ?>
                                <tr>
                                    <td scope="row"><?php echo $autor["nombre"]; ?></td>
                                    <td><?php echo $autor["fechaNacimiento"]; ?></td>
                                    <td><img src="<?php echo (file_exists("../../public_html/img/content/" . $autor["image"])) ? "../../public_html/img/content/" . $autor["image"] : "../../public_html/img/content/default.png"; ?>"
                                            class="border border-dark rounded-circle"
                                            alt="Imagen del autor"
                                            style="width: 75px ; height:75px;">
                                    </td>
                                    <td>
                                        <a href="<?php echo "?enc=Editar&name=" . $autor["nombre"] . "&fecha=" . $autor["fechaNacimiento"] . "&img=" . $autor["image"] . "&id=" . $autor["idAutor"] ?>"
                                            class="btn btn-info">Editar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="card-footer text-muted bg-primary">
                    </div>
                </div>
            </div>
            <script
                src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

            </script>
        </div>
    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>