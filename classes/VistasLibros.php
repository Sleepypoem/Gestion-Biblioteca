<?php
include("../autocargaLIBROS.php");

class VistasLibros implements IConsultarDatos
{
    use Basededatos;

    /**
     * Saca los libros de la base de datos en forma de un array.
     *
     * @return array Un array asociativo con los datos de los libros.
     */
    public function mostrarLibros()
    {
        $sql = "SELECT * FROM v_libros";
        return $this->consultarDatos($sql);
    }

    function consultarDatos($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}