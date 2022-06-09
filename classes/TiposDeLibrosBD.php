<?php

include("../autocargaLIBROS.php");
class TiposDeLibrosBD implements IEnviarDatos, IConsultarDatos
{

    use Basededatos;

    public function registrarCategoria($nombre, $descripcion)
    {
        $sql = "INSERT INTO `tipos-de-libros` ( nombre, descripcion) VALUE('$nombre', '$descripcion')";
        $this->enviarDatos($sql);
    }

    public function consultarCategorias()
    {
        $sql = "SELECT * FROM `tipos-de-libros`";
        return $this->consultarDatos($sql);
    }

    function enviarDatos($sql)
    {
        $stmt = $this->pdo()->prepare($sql);
        $resultadoQuery = $stmt->execute();

        return ($resultadoQuery) ? $this->mensaje('Registrado') : $this->mensaje('Error');
    }

    function mensaje($msj)
    {
        return ("<script>$msj</script>");
    }

    function consultarDatos($sql)
    {
        $stmt = $this->pdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}