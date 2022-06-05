<?php
include("Plantillas/Cabecera.php");

function obtenerNombrePagina()
{
    return "Inicio";
}
?>
<br>

<h1 class="display-4 text-center">Bienvenido al sistema administrador.</h1>
<br>

<body>
    <div class="container d-flex justify-content-center index-flex-parent">
        <!-- la primera fila -->
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/users.png" alt="users">

            </div>
            <div class="card-body card-body-font text-center">

                0
            </div>
            <div class="card-footer text-white text-center bg-dark">
                Usuarios Totales
            </div>
        </div>
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/admins.png" alt="users">
            </div>
            <div class="card-body card-body-font text-center">
                0
            </div>
            <div class="card-footer text-white text-center bg-dark ">
                Administradores
            </div>
        </div>
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/books.png" alt="users">

            </div>
            <div class="card-body card-body-font text-center">
                0
            </div>
            <div class="card-footer text-white text-center bg-dark ">
                Libros
            </div>
        </div>
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/borrowings.png" alt="users">

            </div>
            <div class="card-body card-body-font text-center">
                0
            </div>
            <div class="card-footer text-white text-center bg-dark ">
                Prestamos
            </div>
        </div>
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/returns.png" alt="users">

            </div>
            <div class="card-body card-body-font text-center">
                0
            </div>
            <div class="card-footer text-white text-center bg-dark ">
                Devoluciones pendientes
            </div>
        </div>
        <div class="card index-element index-flex-child">
            <div class="card-header text-center bg-light">
                <img class="card-image" src="img/penaltys.png" alt="users">

            </div>
            <div class="card-body card-body-font text-center">
                0
            </div>
            <div class="card-footer text-white text-center bg-dark ">
                Multas
            </div>
        </div>
    </div>
</body>

<?php
include("Plantillas/Pie.php");
?>