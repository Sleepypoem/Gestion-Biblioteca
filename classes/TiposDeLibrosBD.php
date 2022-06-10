<?php
require_once "ConexionBD.php";
class TiposDeLibrosBD extends ConexionBD
{

    public function registrarCategoria($nombre, $descripcion)
    {
        $sql = "INSERT INTO `tipos-de-libros` (nombre, descripcion) VALUE('$nombre', '$descripcion')";
        $this->enviarDatos($sql);
    }

    public function consultarCategorias()
    {
        $sql = "SELECT * FROM `tipos-de-libros`";
        return $this->consultarDatos($sql);
    }
}
