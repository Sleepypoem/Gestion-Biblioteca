<?php
require_once('../interfaz/IEnviarDatos.php');
class Copias implements IEnviarDatos, IEjecutarSQL
{
    use Basededatos;
    function enviarDatos($sql)
    {
        $this->ejecutaSQL($sql);
    }
    function ejecutaSQL($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
    }
}
