<?php
require_once "./autocargaLIBROS.php";

class Prestamo
{

    private $fechaInicio;
    private $fechaFin;

    function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }
}