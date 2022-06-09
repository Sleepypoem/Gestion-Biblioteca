<?php
require_once "ConexionBD.php";
class CopiasBD extends ConexionBD
{

    function generarCopias($isbn, $cantidad)
    {
        $sql = "CALL insertarCopias('$isbn', $cantidad);";
        $this->enviarDatos($sql);
    }

    public function modificarEstado($id)
    {
        $sql = "UPDATE copias SET estado = 2 WHERE codigo = $id";
        $this->enviarDatos($sql);
    }

    public function obtenerCopias()
    {
        $sql = "SELECT * FROM copias";
        $listaCopias = $this->consultarDatos($sql);
        return $listaCopias;
    }
}