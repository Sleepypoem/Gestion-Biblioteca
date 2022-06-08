<?php
class TiposDeLibros implements IEnviarDatos, IConsultarDatos {
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
}