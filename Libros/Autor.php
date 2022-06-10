<?php

class Autor
{
    private $nombre;
    private $fechaNacimiento;

    function __construct($nombre, $fechaNacimiento)
    {
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
}