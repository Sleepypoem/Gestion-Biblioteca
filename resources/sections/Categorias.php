<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
include SITE_ROOT . "/plantillas/Cabecera.php";
require_once SITE_ROOT . "/classes/Intermediario/Intermediario.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$listaDeCategorias = new Intermediario();
$categorias = $listaDeCategorias->obtenerDeBD("tiposdelibro");

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

                        foreach ($categorias as $categoria) { ?>
                        <tr>
                            <td><?php echo $categoria->nombre ?></td>
                            <td><?php echo $categoria->descripcion ?></td>
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