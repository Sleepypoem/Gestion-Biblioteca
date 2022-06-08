<?php
class Autores implements IEnviarDatos, IConsultarDatos, IEjecutarSQL
{
    use Basededatos;
    function enviarDatos($sql)
    {
    }
    function consultarDatos($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    function ejecutaSQL($sql)
    {
    }
}
