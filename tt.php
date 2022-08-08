<?php

class test
{
    private $hola = "ff";
    #public $hola2 = "dd";
}

$t = new test();
echo json_encode($t);



$i = new Intermediario();
$l = new Libro($i);
$l = $l->crearDesdeArray($datos);
print_r($l->datosComoArray());
$l->guardar();