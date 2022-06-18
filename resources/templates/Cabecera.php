<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Organizacion-prueba/config.php";
/* ************************************************************************************************************************************************ */
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://iconarchive.com/download/i75808/martz90/circle/books.ico">
        <!--Bootstrap 5 CSS only -->
        <link href="<?php echo $config["urls"]["baseUrl"] . "/public_html/css/bootstrap.css"; ?>"
            rel="stylesheet">
        <!-- Para las tablas -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

        <title>Gestion de Biblioteca | <?php echo obtenerNombrePagina() ?></title>
        <link rel="stylesheet"
            href="<?php echo $config["urls"]["baseUrl"] . "/public_html/css/customStyleSheet.css"; ?>">

        <!-- Aqui empieza la NavBar -->

        <nav
            class="navbar navbar-expand-xl justify-content-center navbar-light navbar-dark bg-primary shadow-lg p-3 mb-5 bg-white rounded">
            <div class=" container">
                <a class="navbar-brand"
                    href="<?php echo $config["urls"]["baseUrl"] . "/index.php"; ?>">Biblioteca</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="PrestamosDropDown"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Préstamos</a>
                            <div class="dropdown-menu" aria-labelledby="Acciones-Libros">
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Prestamos.php"; ?>">Hacer
                                préstamo</a>
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/HistorialDePrestamos.php"; ?>">Historial
                                de
                                préstamos</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Devoluciones.php"; ?>">Devoluciones
                            <span class="visually-hidden">(current)</span></a></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="LibrosDropDown"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Libros</a>
                            <div class="dropdown-menu" aria-labelledby="Acciones-Libros">
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Catalogo.php"; ?>">Catalogo</a>
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Agregar.php"; ?>">Añadir
                                libro</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="CategoriasDropDown"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Categorias</a>
                            <div class="dropdown-menu" aria-labelledby="Acciones-Libros">
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/Categorias.php"; ?>">Ver
                                categorias</a>
                                <a class="dropdown-item"
                                    href="<?php echo $config["urls"]["baseUrl"] . "/resources/sections/AgregarCategorias.php"; ?>">Añadir
                                categoria</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- JQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Bootstrap icons -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <!-- Bootstrap growl -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.js"
            integrity="sha512-4fpPq5LCcSAofCKmaM58RSbjpVRUqjx8nKAaBQVFay4MRo7FLafbt6bUNUfUbTZcSMzRNxZuVj3shwHA6ZeiOQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- DataTables -->
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
        </script>

        <!-- Bootstrap DataTable -->
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <!-- Local bootstrap js -->
        <script
            src="<?php echo $config["urls"]["baseUrl"] . "/public_html/js/bootstrap.bundle.js"; ?>">
        </script>


    </head>
    <br>