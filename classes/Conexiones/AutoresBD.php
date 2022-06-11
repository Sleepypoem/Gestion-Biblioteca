<?php

require_once "ConexionBD.php";
class AutoresBD extends ConexionBD
{
    private $autor;

    public function prepararDatos($autor)
    {
        $this->autor = $autor;
    }

    public function enviaraBD()
    {
        $sql = "INSERT INTO autor (nombre, fechaNacimiento, image) VALUES (" . $this->autor->getNombre() . ", " .
            $this->autor->getFechaDeNacimiento() . ", " . $this->autor->getImagen() . ")";

        $this->enviarDatos($sql);
    }

    public function editarEnBD($id, $datos)
    {
    }

    public function obtenerDeBD()
    {
        $sql = "SELECT * FROM autor";

        $listaAutores = $this->consultarDatos($sql);
        return $listaAutores;
    }
}