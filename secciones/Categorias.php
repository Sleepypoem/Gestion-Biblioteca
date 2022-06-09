<?php
include("../Plantillas/Cabecera.php");
require_once("../classes/TiposDeLibrosBD.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$tiposdeLibros = new TiposDeLibrosBD();

?>
<br>
<br>

<body>
    <div class="container align-items-center">
        <div class="row">

            <div class="container">
                <div class="card">
                    <div class="card-header card-header text-white text-center bg-dark">
                        Categorias
                    </div>
                    <div class="card-body">
                        <!-- Aqui va la lista de libros sacados de la base de datos -->
                        <table class="darkTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aqui van los datos de la base de datos -->
                                <?php
                                $categorias = $tiposdeLibros->consultarCategorias();

                                foreach ($categorias as $categoria) { ?>
                                <tr>
                                    <td><?php echo $categoria["nombre"] ?></td>
                                    <td><?php echo $categoria["descripcion"] ?></td>
                                </tr>

                                <?php } ?>
                            </tbody>
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