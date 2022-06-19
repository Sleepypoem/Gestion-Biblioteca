<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeLibros.php";
include_once TEMPLATES . "/Cabecera.php";
require_once VIEWS . "/CrearComponentes.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$rutaImg = "../../public_html/img/content/";


function  moverImagen($nombreTemporal, $ruta, $nombreImagen)
{
    $fechaDeHoy = new DateTime();
    $img = "img_" . $fechaDeHoy->getTimestamp() . "_" . $nombreImagen;
    move_uploaded_file($nombreTemporal, $ruta . "/" . $img);

    return $img;
}

$intermediario = new Intermediario();
$creador = new CrearComponentes();
$listaAutores = $intermediario->obtenerDeBD("autor");
$tiposDeLibros = $intermediario->obtenerDeBD("tipos-de-libros");

if ($_POST) {
    $gestor = new GestorDeLibros($_POST["isbn"], $_POST["titulo"], $_POST["autor"], $_POST["tipo-libro"], $_POST["copias"]);
    if (isset($_FILES["libro"])) {
        $gestor->setImagen(moverImagen($_FILES["libro-imagen"]["tmp_name"], $rutaImg, $_FILES["libro-imagen"]["name"]));
    } else {
        $gestor->setImagen($rutaImg . "/default.png");
    }

    $gestor->setCodigoBibliotecario(1000);
    echo $gestor->registrarLibro();
}
?>

<body>

    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-primary">
                    Añadir un nuevo libro
                </div>
                <div class="card-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">
                                Ingresa el ISBN del libro
                            </label>

                            <?php $creador->crearFormElemento("text", "bi bi-journal-bookmark-fill", "isbn", "required"); ?>


                            <small id="helpId" class="form-text text-muted">
                                Buscalo en la contraportada o en la página de copyright.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Ingresa el titulo del libro
                            </label>

                            <?php $creador->crearFormElemento("text", "bi bi-journal-text", "titulo", "required"); ?>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Ingresa el autor del libro
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="select-test">
                                        <i class="bi bi-person-lines-fill"></i>
                                    </span>
                                </div>
                                <select name="autor" class="form-control">
                                    <?php
                                    foreach ($listaAutores as $autor) {
                                    ?>
                                    <option value="<?= $autor["idAutor"]; ?>">
                                        <?= $autor["nombre"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="select-test">
                                        <a
                                            href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/AgregarAutor.php"; ?>"><i class="bi bi-person-lines-fill"> Añadir</i></a>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                ¿Que tipo de libro es?
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="select-test">
                                        <i class="bi bi-bookmark-star"></i>
                                    </span>
                                </div>

                                <select name="tipo-libro" class="form-control">
                                    <?php
                                    foreach ($tiposDeLibros as $tipolibro) {
                                    ?>
                                    <option value="<?= $tipolibro["idtipoLibro"]; ?>">
                                        <?= $tipolibro["nombre"]; ?>
                                    </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="select-test">
                                        <a
                                            href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/AgregarAutor.php"; ?>"><i class="bi bi-bookmark-plus"> Añadir</i></a>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <label class="form-label">Ingresa la cantidad de copias</label>
                        <?php $creador->crearFormElemento("number", "bi bi-plus-slash-minus", "copias", "value=\"1\""); ?>
                        <br>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Elegir imagen</label>
                            <input type="file" class="form-control" name="libro-imagen" id="imagen">
                            <div class="form-text">Ingresa una imagen de la portada</div>
                        </div>

                        <input type="hidden" class="form-control" value="libro" name="form-id"
                            aria-describedby="identificador-de-formulario">
                        <br>
                        <button type="submit" class="btn btn-success">
                            <div class="btn-group">
                                <i class="bi bi-book"> Añadir
                                    libro </i>
                            </div>

                        </button>
                    </form>

                </div>
                <div class="card-footer bg-primary text-muted">

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