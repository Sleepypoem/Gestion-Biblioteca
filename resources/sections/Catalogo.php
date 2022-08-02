<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__, 3) . "/config.php";
require_once CONTROLLERS . "/Intermediario.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */

/* ************************************************************* Variables por defecto ************************************************************ */
$intermediario = new Intermediario();
$sql = "SELECT * FROM v_libros";
$listaDeLibros = $intermediario->ejecutarSQL($sql);
$rutaImg = "../../public_html/img/content/";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}
?>
<h1 class="text-center pb-2">Catalogo de libros</h1>

<body>

    <!-- Aqui va la lista de libros sacados de la base de datos -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-white text-center bg-primary">
            </div>
            <div class="card-body">

                <table class="table table-striped table-primary" id="tabla-libros">
                    <thead class="text-center">
                        <tr>
                            <th>ISBN</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Tipo de Libro</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui van los datos de la base de datos -->
                        <?php

                        foreach ($listaDeLibros as $libro) {
                        ?>
                        <tr>
                            <td><?php echo $libro["isbn"] ?></td>
                            <td><?php echo $libro["titulo"] ?></td>
                            <td><?php echo $libro["Autor"] ?></td>
                            <td><?php echo $libro["Tipo de Libro"] ?></td>
                            <td>
                                <img src="<?php echo (file_exists($rutaImg . $libro["image"])) ? $rutaImg . $libro["image"] : $rutaImg . "default.png"; ?>"
                                    class="border border-dark " alt="Imagen del autor"
                                    style="width: 70px ; height:85px;">
                            </td>
                            <td>
                                <a name="editar" class="btn btn-warning"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/AgregarLibros.php?id=" . $libro["id libro"]; ?>">
                                        Editar
                                    </a>
                                <a name="revisar-copias" class="btn btn-success"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Copias.php?isbn=" . $libro["isbn"]; ?>">
                                        ver copias
                                    </a>
                            </td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>

                <script
                    src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/paginacion.js"; ?>">

                </script>

            </div>
            <div class="card-footer bg-primary text-muted">
            </div>
        </div>

    </div>




</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>