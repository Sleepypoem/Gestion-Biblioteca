<?php

namespace Alexander\Biblioteca\classes\connections;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use PDO;
use PDOException;
/* ************************************************************************************************************************************************ */

class ConexionBD
{
    protected static $instancia = null;
    private $pdo;

    private function __construct()
    {
        $host = BD_HOST;
        $bd_name = BD_NOMBRE;
        $username = BD_USUARIO;
        $password = BD_CONTRASENIA;
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$bd_name", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return "Conexion establecida!";
        } catch (PDOException $e) {
            return "Error al conectarse. Error" . $e;
        }
    }

    public static function getInstance()
    {
        if (IS_NULL(self::$instancia)) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}