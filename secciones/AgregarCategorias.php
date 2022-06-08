<?php
include("../Plantillas/Cabecera.php");
require_once("../classes/TiposDeLibros.php");

function obtenerNombrePagina()
{
    return "Añadir Categoria";
}

if ($_POST) {
    $nombre = $_POST["nombre-categoria"];
    $descripcion = $_POST["descripcion-categoria"];

    $datosCategoria = [$nombre, $descripcion];
    $nuevaCategoria = new TiposDeLibros();
    $nuevaCategoria->enviarDatos($datosCategoria);
}

?>

<body>

    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">

            <div class="card">
                <div class="card-header card-header text-white text-center bg-dark">
                    Añadir una nueva categoria
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Ingresa el nombre de la categoria</label>
                            <input type="text" class="form-control" name="nombre-categoria"
                                aria-describedby="nombre-categoria" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Ingresa una descripcion para la categoria</label>
                            <textarea class="form-control" name="descripcion-categoria" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Añadir categoria</button>

                    </form>

                </div>

                <div class="card-footer bg-dark text-muted">

                </div>
            </div>
        </div>

</body>