<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once SITE_ROOT . "/Interfaz/IConsultarDatos.php";
require_once SITE_ROOT . "/Interfaz/IEnviarDatos.php";
require_once SITE_ROOT . "/Interfaz/IConsultarDatos.php";
/* ************************************************************************************************************************************************ */

abstract class ConexionBD implements IEnviarDatos, IConsultarDatos
{
    protected function pdo()
    {
        $host = "mysql:host=localhost;dbname=bd_biblioteca";
        $username = "root";
        $password = "";
        $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];

        try {
            $pdo = new PDO($host, $username, $password, $option);
            if ($pdo instanceof PDO) {
                return $pdo;
            } else {
                throw new Exception(message: "Database not found");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public abstract function obtenerDeBD();

    public abstract function enviaraBD();

    public abstract function editarEnBD($id, $datos);

    function enviarDatos($sql)
    {
        $stmt = $this->pdo()->prepare($sql);
        $queryResult = $stmt->execute();
        return ($queryResult) ? $this->mensaje('Registrado') : $this->mensaje('Error');
    }

    function consultarDatos($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function mensaje($msj)
    {
        return ('<script>$msj</script>');
    }
}