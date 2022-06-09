<?php
include("../Plantillas/Cabecera.php");
require_once("../classes/LibrosBD.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$conexionLibros = new LibrosBD();
?>
<br>
<br>

<body>
    <div class="container align-items-center">
        <div class="row">

            <div class="container">

                <!-- Aqui va la lista de libros sacados de la base de datos -->
                <table class="table table-hover table-bordered border-danger">
                    <thead class="table-dark">
                        <tr>
                            <th>ISBN</th>
                            <th>Titulo</th>
                            <th>Copias</th>
                            <th>Autor</th>
                            <th>Tipo de Libro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui van los datos de la base de datos -->
                        <?php $libros = $conexionLibros->obtenerLibros();

                        foreach ($libros as $libro) { ?>
                        <tr>
                            <td><?php echo $libro->isbn ?></td>
                            <td><?php echo $libro->titulo ?></td>
                            <td><?php echo $libro->copias ?></td>
                            <td><?php echo $libro->Autor ?></td>
                            <td><?php echo $libro->{'Tipo de Libro'} ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<?php
include("../Plantillas/Pie.php");
?>