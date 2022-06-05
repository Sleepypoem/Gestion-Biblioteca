<?php
$url = "http://" . $_SERVER["HTTP_HOST"] . "/public/Gestion Biblioteca/";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://iconarchive.com/download/i75808/martz90/circle/books.ico">
    <!--Bootstrap 5 CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Gestion de Biblioteca | <?php echo obtenerNombrePagina() ?></title>
    <link rel="stylesheet" href="<?php echo $url . "css/customStyleSheet.css"; ?>">

    <!-- Aqui empieza la NavBar -->

    <nav class="navbar navbar-expand-xl justify-content-center navbar-light bg-light navbar-dark bg-dark"
        style="box-shadow: 1px 2px 10px 5px #000000;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $url . "index.php"; ?>">Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo $url . "secciones/Prestamos.php" ?>">Prestamos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url . "secciones/Devoluciones.php" ?>">Devoluciones
                            <span class="visually-hidden">(current)</span></a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url . "secciones/Catalogo.php" ?>">Catalogo</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Este script sirve para que la navbar cambie de tamaño cuando se ve desde moviles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</head>