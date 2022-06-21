<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONTROLLERS . "/GestorDeLibros.php";
include_once TEMPLATES . "/Cabecera.php";
require_once VIEWS . "/CrearComponentes.php";
/* ************************************************************************************************************************************************ */

/* ********************************************************* Valores por defecto sin $_GET ******************************************************** */
$intermediario = new Intermediario();
$rutaImg = "../../public_html/img/content/";
$encabezado = "Agregar";
$agregar = true;
$isbn = "";
$titulo = "";
$idAutor = "";
$idTipoLibro = "";
$nombreImagen = "";
$copias = 1;
$id;
/* ************************************************************************************************************************************************ */

if ($_GET) {
    $id = $_GET["id"];
    $encabezado = "Editar";
    $agregar = false;

    /* ******************************************************* Obtener informacion de los libros ****************************************************** */
    $sql = "SELECT * FROM libro WHERE id = $id";
    $libros = $intermediario->ejecutarSQL($sql);

    $isbn = $libros[0]["isbn"];
    $titulo = $libros[0]["titulo"];
    $idAutor = $libros[0]["idAutor"];
    $idTipoLibro = $libros[0]["tipoLibro"];
    $nombreImagendb = $libros[0]["image"];
    /* ************************************************************************************************************************************************ */
}

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

function  moverImagen($nombreTemporal, $ruta, $nombreImagen)
{
    $fechaDeHoy = new DateTime();
    $img = "img_" . $fechaDeHoy->getTimestamp() . "_" . $nombreImagen;
    move_uploaded_file($nombreTemporal, $ruta . "/" . $img);

    return $img;
}

/* *********************************************** Obteniendo las listas de autores y tipos de libro ********************************************** */
$listaAutores = $intermediario->obtenerDeBD("autor");
$tiposDeLibros = $intermediario->obtenerDeBD("tipos-de-libros");
/* ************************************************************************************************************************************************ */

if ($_POST) {

    $isbn = $_POST["isbn"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $tipoLibro = $_POST["tipo-libro"];


    //Si agregar es true significa que estamos agreaando un nuevo libro, si es false, lo estamos editando
    if ($agregar) {
        $copias = $_POST["copias"];
        $gestor = new GestorDeLibros($isbn, $titulo, $autor, $tipoLibro, $copias, $intermediario);
        if (isset($_FILES["libro-imagen"])) {
            $nombreTempImagen = $_FILES["libro-imagen"]["tmp_name"];
            $nombreImagen = $_FILES["libro-imagen"]["name"];
            $gestor->setImagen(moverImagen($nombreTempImagen, $rutaImg, $nombreImagen));
        } else {
            $gestor->setImagen("default.png");
        }

        $gestor->setCodigoBibliotecario(1000);
        echo $gestor->registrarLibro();
    } else {

        /* ************************************************* Contando las copias de un libro en especifico ************************************************ */
        $sql = "SELECT COUNT(0) as copias FROM copias WHERE isbn = '$isbn'";
        $copias = $intermediario->ejecutarSQL($sql)[0]["copias"];
        /* ************************************************************************************************************************************************ */

        $gestor = new GestorDeLibros($isbn, $titulo, $autor, $tipoLibro, $copias, $intermediario);
        if (isset($_FILES["libro-imagen"])) {

            $nombreTempImagen = $_FILES["libro-imagen"]["tmp_name"];
            $nombreImagen = $_FILES["libro-imagen"]["name"];

            //si una nueva imagen es pasada al editar el libro tenemos que borrar la anterior, excepto si es la de default
            if ($nombreImagendb !== "default.png") {
                file_exists($rutaImg . $nombreImagendb) ? unlink($rutaImg . $nombreImagendb) : $rutaImg . $nombreImagendb;
            }


            $gestor->setImagen(moverImagen($nombreTempImagen, $rutaImg, $nombreImagen));
        } else {
            //si no pasan imagen le dejamos la que tenia
            $gestor->setImagen($nombreImagen);
        }

        $gestor->setCodigoBibliotecario(1000);
        echo $gestor->editarLibro($id);
    }


    /* **************************************************** refresca la pagina al pasar 2 segundos **************************************************** */
    $archivoActual = $_SERVER['PHP_SELF'];
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=$archivoActual\">";
    /* ************************************************************************************************************************************************ */
}
?>

<body>

    <div class="container align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-primary">
                    <?php echo $encabezado ?> libro
                </div>
                <div class="card-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">
                                Ingresa el ISBN del libro
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </span>
                                </div>
                                <input type="text" name="isbn" class="form-control"
                                    placeholder="0-0000-0000-0" value="<?php echo $isbn ?>">
                            </div>
                            <small id="helpId" class="form-text text-muted">
                                Buscalo en la contraportada o en la página de copyright.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Ingresa el titulo del libro
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-journal-text"></i>
                                    </span>
                                </div>
                                <input type="text" name="titulo" class="form-control"
                                    placeholder="Escribe el titulo del libro"
                                    value="<?php echo $titulo ?>">
                            </div>
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
                                    <option value="<?= $autor["idAutor"] ?>"
                                        <?php echo ($autor["idAutor"] == $idAutor) ? "selected" : "" ?>>
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
                                    <option value="<?= $tipolibro["idtipoLibro"]; ?>"
                                        <?php echo ($tipolibro["idtipoLibro"] == $idTipoLibro) ? "selected" : "" ?>>
                                        <?= $tipolibro["nombre"]; ?>
                                    </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="select-test">
                                        <a
                                            href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/AgregarCategorias.php"; ?>"><i class="bi bi-bookmark-plus"> Añadir</i></a>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label
                                class="form-label"><?php echo (!$agregar) ? "No se puede añadir o quitar copias desde aqui" : "Ingresa la cantidad de copias" ?>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="select-test">
                                        <i class="bi bi-plus-slash-minus"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" name="copias"
                                    value="<?php echo $copias ?>"
                                    <?php echo (!$agregar) ? "disabled" : "" ?>>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="imagen"
                                class="form-label"><?php echo (!$agregar) ? "Imagen actual: " . $nombreImagendb : "Ingresa una imagen" ?></label>
                            <input type="file" class="form-control" name="libro-imagen" id="imagen">
                            <div class="form-text">Selecciona una imagen de portada</div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">
                            <div class="btn-group">
                                <i class="bi bi-book">
                                    <?php echo $encabezado ?> libro
                                </i>
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