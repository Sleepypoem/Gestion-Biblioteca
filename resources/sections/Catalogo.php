<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
include_once TEMPLATES . "/Cabecera.php";
/* ************************************************************************************************************************************************ */


function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

$intermediario = new Intermediario();
$sql = "SELECT * FROM v_libros";
$listaDeLibros = $intermediario->ejecutarSQL($sql);

?>
<br>
<br>

<body>

    <!-- Aqui va la lista de libros sacados de la base de datos -->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered border-danger ">
                <thead class="table-dark">
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
                        <td><?php echo $libro["image"] ?></td>
                        <td class="align-items-center">
                            <a name="editar" class="btn btn-outline-info" href="#">Editar</a>
                            <a name="borrar" class="btn btn-outline-danger" href="#">Borrar</a>
                            <a name="revisar-copias" class="btn btn-outline-success"
                                href="#">ver copias</a>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>




</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>