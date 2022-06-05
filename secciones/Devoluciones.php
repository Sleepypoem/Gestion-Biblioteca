<?php
include("../Plantillas/Cabecera.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}
?>
Aqui iran las devoluciones
<?php
include("../Plantillas/Pie.php");
?>