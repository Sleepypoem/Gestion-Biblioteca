<?php
require_once "ConexionBD.php";
class CopiasBD extends ConexionBD
{

    private $copia;
    private $cantidad;

    public function prepararDatos($copia, $cantidad)
    {
        $this->copia = $copia;
        $this->cantidad = $cantidad;
    }

    function enviaraBD()
    {
        $sql = "CALL insertarCopias('" . $this->copia->getisbn() . "', $this->cantidad);";
        $this->enviarDatos($sql);
    }

    public function editarEnBD($id, $estado)
    {
        $sql = "UPDATE copias SET estado = $estado WHERE codigo = $id";
        $this->enviarDatos($sql);
    }

    public function obtenerDeBD()
    {
        $sql = "SELECT * FROM copias";
        $listaCopias = $this->consultarDatos($sql);
        return $listaCopias;
    }
}