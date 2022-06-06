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
<br>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header card-header text-white text-center bg-dark">
                        Añadir un nuevo libro
                    </div>
                    <div class="card-body">

                        <form action="Catalogo.php" method="post">
                            <div class="mb-3">
                                <label class="form-label">Ingresa el ISBN del libro</label>
                                <input type="text" class="form-control" name="isbn" aria-describedby="book-isbn"
                                    required>
                                <small id="helpId" class="form-text text-muted">Buscalo en la contraportada o en la
                                    página de copyright.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ingresa el titulo del libro</label>
                                <input type="text" class="form-control" name="titulo" aria-describedby="titulo"
                                    required>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header text-white text-center bg-dark">
                        Catalogo de libros
                    </div>
                    <div class="card-body">
                        <!-- Aqui va la lista de libros sacados de la base de datos -->
                        <table class="darkTable">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Titulo</th>
                                    <th>ID de Autor</th>
                                    <th>Copias</th>
                                    <th>Tipo de Libro</th>
                                    <th>Codigo de bibliotecario</th>
                                    <th>Estado</th>
                                    <th>Fecha añadido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aqui van los datos de la base de datos -->
                                <?php $libros = $conexionLibros->leerTodos();
                                foreach ($libros as $libro) { ?>
                                <tr>
                                    <td><?php echo $libro["isbn"] ?></td>
                                    <td><?php echo $libro["titulo"] ?></td>
                                    <td><?php echo $libro["copias"] ?></td>
                                    <td><?php echo $libro["idAutor"] ?></td>
                                    <td><?php echo $libro["tipoLibro"] ?></td>
                                    <td><?php echo $libro["codigoBbliotecario"] ?></td>
                                    <td><?php echo $libro["estado"] ?></td>
                                    <td><?php echo $libro["fechaRegistro"] ?></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer bg-dark text-muted">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include("../Plantillas/Pie.php");
?>