<?php
include("../Plantillas/Cabecera.php");
require_once("../classes/LibrosBD.php");
require_once("../classes/AutoresBD.php");
require_once("../Libros/Libro.php");
require_once("../classes/TiposDeLibrosBD.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

if ($_POST) {

    $isbn = $_POST["isbn"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $tipoLibro = $_POST["tipo-libro"];
    $codigo = $_POST["codigo-bibliotecario"];
    $cantidad = $_POST["copias"];

    $libro = new Libro($isbn, $titulo, $autor, $tipoLibro);

    $libroInsert = new LibrosBD();
    $libroInsert->registrarLibro($libro, $codigo, $cantidad);
}
?>

<br>

<body>

    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-dark">
                    Añadir un nuevo libro
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Ingresa el ISBN del libro</label>
                            <input type="text" class="form-control" name="isbn" aria-describedby="book-isbn" required>
                            <small id="helpId" class="form-text text-muted">Buscalo en la contraportada o en la
                                página de copyright.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa el titulo del libro</label>
                            <input type="text" class="form-control" name="titulo" aria-describedby="titulo" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Ingresa el autor del libro</label>
                            <?php $sql = 'SELECT * FROM autor;';
                            $autores = new AutoresBD();
                            $datosAutor = $autores->consultarDatos($sql);
                            ?>
                            <select name="autor" id="autor" class="form-control">
                                <?php
                                foreach ($datosAutor as $autor) {
                                ?>
                                <option value="<?= $autor->idAutor; ?>"><?= $autor->nombre; ?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa el tipo de libro</label>
                            <?php
                            $tiposDeLibros = new TiposDeLibrosBD();
                            $datosTLIB = $tiposDeLibros->consultarCategorias();
                            ?>
                            <select name="tipo-libro" id="tipo-libro" class="form-control">
                                <?php
                                foreach ($datosTLIB as $tplib) {
                                ?>
                                <option value="<?= $tplib->idtipoLibro; ?>"><?= $tplib->nombre; ?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>

                        <label class="form-label">Ingresa la cantidad de copias</label>
                        <input class="form-control" type="number" name="copias" id="copias-id" value="1">
                        <br>

                        <div class="mb-3">

                            <input type="hidden" class="form-control" value="1000" name="codigo-bibliotecario"
                                aria-describedby="codigo-bibliotecario" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Añadir libro</button>
                    </form>

                </div>
                <div class="card-footer bg-dark text-muted">

                </div>
            </div>
        </div>
    </div>

</body>