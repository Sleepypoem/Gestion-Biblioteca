<?php
include("../Plantillas/Cabecera.php");
require_once("../Database/ConexionLibros.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$conexionLibros = new ConexionLibros("localhost", "bd_biblioteca", "root", "", "libro");
$conexionLibros->conectar();
?>
<br>
<br>

<body>
    <div class="container align-items-center">
        <div class="row">

            <div class="container">
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
                                    <th>Codigo de Bibliotecario</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
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