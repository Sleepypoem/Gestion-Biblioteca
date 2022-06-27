<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once INTERFACES . "/IEjecutarSQL.php";
require_once INTERFACES . "/IAgregarBD.php";
require_once INTERFACES . "/IConsultarBD.php";
/* ************************************************************************************************************************************************ */

class ConexionBD implements IEjecutarSQL, IAgregarBD, IConsultarBD
{
    protected static $conexiones = [];
    private $pdo;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        $clase = static::class;
        if (!isset(self::$conexiones[$clase])) {
            self::$conexiones[$clase] = new static();
        }

        return self::$conexiones[$clase];
    }

    public function conectar($host, $bd_name, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$bd_name", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
            if ($this->pdo instanceof PDO) {
                return $this->pdo;
            } else {
                throw new Exception(message: "No se encontro la base de datos");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function agregarBD($sql): bool
    {
        $query = $this->pdo->prepare($sql);
        return $query->execute();
    }

    public function consultarBD($sql): array
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ejecutaSQL($sql)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}