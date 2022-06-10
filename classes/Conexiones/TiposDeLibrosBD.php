<?php
require_once "ConexionBD.php";
class TiposDeLibrosBD extends ConexionBD
{

    private $tipoDeLibro;

    public function prepararDatos($tipoDeLibro)
    {
        $this->tipoDeLibro = $tipoDeLibro;
    }

    public function enviaraBD()
    {
        $sql = "INSERT INTO `tipos-de-libros` (nombre, descripcion) 
        VALUE ('" . $this->tipoDeLibro->getNombre() . "', '" . $this->tipoDeLibro->getDescripcion() . "')";
        $this->enviarDatos($sql);
    }

    public function editarEnBD($id, $datos)
    {
    }

    public function obtenerdeBD()
    {
        $sql = "SELECT * FROM `tipos-de-libros`";
        return $this->consultarDatos($sql);
    }
}