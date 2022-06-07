<?php
include("../Plantillas/Cabecera.php");
require_once("../Database/ConexionLibros.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$conexionLibros = new ConexionLibros("localhost", "bd_biblioteca", "root", "", "libro");
$conexionLibros->conectar();
if ($_POST) {

    $isbn = $_POST["isbn"];
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $tipoLibro = $_POST["tipo-libro"];
    $codigo = $_POST["codigo"];
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

                    <form action="Catalogo.php" method="post">
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
                            <input type="text" class="form-control" name="autor" aria-describedby="autor" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa el tipo de libro</label>
                            <input type="text" class="form-control" name="tipo-libro" aria-describedby="tipo-libro"
                                required>
                            <small id="helpId" class="form-text text-muted">Ejemplo: ficción, educativo,
                                etc.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingresa tu codigo</label>
                            <input type="text" class="form-control" name="codigo-bibliotecario"
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