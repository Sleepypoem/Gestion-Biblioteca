<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__, 3) . "/config.php";
require_once INTERFACES . "/IEjecutarSQL.php";
/* ************************************************************************************************************************************************ */


class ConexionBD implements IEjecutarSQL
{
    private $host = "mysql:host=localhost;dbname=bd_biblioteca";
    private $bd_name = "bd_biblioteca";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct($host, $bd_name, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$bd_name", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
            if ($this->pdo instanceof PDO) {
                return $this->pdo;
            } else {
                throw new Exception(message: "Database not found");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function ejecutaSQL($sql)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}