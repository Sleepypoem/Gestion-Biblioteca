<?php

$cantidad = 0;
$inicio = 0;
$fin = 0;

function contarElementos($intermediario, $nombre)
{
    $sql = "SELECT COUNT(0) as $nombre" . "Cantidad" . " FROM `$nombre`;";
    $cantidad = $intermediario->ejecutarSQL($sql);
    return $cantidad[0][$nombre . "Cantidad"];
}
function llenarLista($intermediario, $inicio, $fin)
{
    $sql = "SELECT * FROM `autor` WHERE idAutor >= $inicio AND idAutor < $fin;";
    $listaAutores = $intermediario->ejecutarSQL($sql);
}