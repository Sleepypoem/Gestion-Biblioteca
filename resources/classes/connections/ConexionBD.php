<?php

namespace Alexander\Biblioteca\classes\connections;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\interfaces\IEjecutarSQL as IEjecutarSQL;
use Alexander\Biblioteca\classes\interfaces\IAgregarBD as IAgregarBD;
use Alexander\Biblioteca\classes\interfaces\IConsultarBD as IConsultarBD;
use PDO;
use PDOException;
/* ************************************************************************************************************************************************ */

class ConexionBD implements IEjecutarSQL, IAgregarBD, IConsultarBD
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

    public function iniciarTransaccion()
    {
        $this->pdo->beginTransaction();
    }

    public function guardarCambios()
    {
        $this->pdo->commit();
    }

    public function descartarCambios()
    {
        $this->pdo->rollBack();
    }

    public static function getInstance()
    {
        if (IS_NULL(self::$instancia)) {
            self::$instancia = new self();
        }
        return self::$instancia;
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