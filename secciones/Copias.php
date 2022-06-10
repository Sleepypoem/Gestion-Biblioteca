<?php
include("../Plantillas/Cabecera.php");
require_once("../classes/CopiasBD.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$copias = new CopiasBD();

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
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui van los datos de la base de datos -->
                        <?php
                        $copias = $copias->obtenerCopias();

                        foreach ($copias as $copia) { ?>
                        <tr>
                            <td><?php echo $copia->codigo ?></td>
                            <td><?php echo $copia->isbn ?></td>
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