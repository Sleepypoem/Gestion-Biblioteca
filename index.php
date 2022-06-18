<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
include_once TEMPLATES . "/Cabecera.php";
require_once VIEWS . "/CrearComponentes.php";
/* ************************************************************************************************************************************************ */

function obtenerNombrePagina()
{
    return "Inicio";
}
$creador = new CrearComponentes();
?>
<br>

<h1 class="display-4 text-center">Bienvenido al sistema administrador.</h1>
<br>

<body>
    <div class="container d-flex justify-content-center index-flex-parent">
        <!-- la primera fila -->
        <?php $creador->crearTarjeta(0, "bi bi-person-circle", "Usuarios Totales"); ?>
        <?php $creador->crearTarjeta(0, "bi bi-person-video2", "Administradores"); ?>
        <?php $creador->crearTarjeta(0, "bi bi-book", "Libros"); ?>
        <?php $creador->crearTarjeta(0, "bi bi-arrow-up-circle-fill", "Prestamos"); ?>
        <?php $creador->crearTarjeta(0, "bi bi-arrow-down-circle-fill", "Devoluciones"); ?>
        <?php $creador->crearTarjeta(0, "bi bi-cash-coin", "Multas"); ?>

    </div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
?>