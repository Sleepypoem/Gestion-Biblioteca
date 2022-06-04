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
    <title>Gestion de Biblioteca</title>
    <style>
    .index-element {
        border: 4px solid rgb(204, 68, 0);
        border-radius: 10px;
        box-shadow: 0px 8px 20px 3px rgba(112, 112, 112, 0.88);
    }

    .index-element:hover {
        transform: scale(1.1);
    }

    .index-font {
        font-family: "Lucida Sans Unicode", Charcoal, sans-serif;
        font-size: 150px;
        letter-spacing: 0.8px;
        word-spacing: 0.6px;
        color: #000000;
        font-weight: 700;
        text-decoration: none;
        font-style: normal;
        font-variant: normal;
        text-transform: none;
    }

    .index-flex-parent {
        display: flex;
        flex-direction: row-reverse;
        gap: 40px;
        flex-wrap: wrap;
    }

    .index-flex-child {
        width: 350px;
        height: 350px;
    }
    </style>

    <!-- Aqui empieza la NavBar -->
    <nav class="navbar navbar-expand-xl justify-content-center navbar-dark bg-dark"
        style="box-shadow: 1px 2px 10px 5px #000000;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $url . "index.php"; ?>">Biblioteca</a>
            <button class=" navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
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



</head>