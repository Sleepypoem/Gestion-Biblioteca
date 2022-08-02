<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__, 3) . "/config.php";
require_once CONTROLLERS . "/Intermediario.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$listaDeCategorias = new Intermediario();
$categorias = $listaDeCategorias->obtenerDeBD("tipos-de-libros");

?>

<h1 class="text-center pb-2">Categorias de libros</h1>

<body>
    <div class="container-fluid">

        <!-- Aqui va la lista de libros sacados de la base de datos -->
        <div class="card">
            <div class="card-header bg-primary">
            </div>
            <div class="card-body">

                <table class="table table-striped table-primary" id="tabla-categorias">
                    <thead class="text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui van los datos de la base de datos -->
                        <?php

                        foreach ($categorias as $categoria) { ?>
                        <tr>
                            <td><?php echo $categoria["nombre"] ?></td>
                            <td><?php echo $categoria["descripcion"] ?></td>
                            <td><a href="AgregarCategorias.php?id=<?php echo $categoria["idtipoLibro"]  ?>"
                                    class="btn w-90 btn-warning">Editar</a></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>
            <div class="card-footer bg-primary text-muted">
            </div>
        </div>
        <script src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

        </script>
    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>