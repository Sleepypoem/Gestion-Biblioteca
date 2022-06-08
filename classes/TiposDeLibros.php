<?php

include("../autocargaLIBROS.php");
class TiposDeLibros implements IEnviarDatos, IConsultarDatos
{

    use Basededatos;

    function enviarDatos($array)
    {
        $sql = "INSERT INTO `tipos-de-libros` ( nombre, descripcion) VALUE('$array[0]', '$array[1]')";
        $query = $this->pdo()->prepare($sql);
        $agregarCategoria = $query->execute();

        return ($agregarCategoria) ? $this->mensaje('Registrado') : $this->mensaje('Error');
    }

    function mensaje($msj)
    {
        return ("<script>$msj</script>");
    }

    function consultarDatos($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}