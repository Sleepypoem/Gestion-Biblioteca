<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use PDOStatement;
use Alexander\Biblioteca\classes\connections\ConexionBD as ConexionBD;
use Alexander\Biblioteca\classes\interfaces\IEjecutarSQL;

/* ************************************************************************************************************************************************ */

class Intermediario implements IEjecutarSQL
{
    private $pdo;

    function __construct(ConexionBD $conexion = null)
    {
        if ($conexion === null) {
            $conexion = ConexionBD::getInstance();
            $this->pdo = $conexion->getPDO();
        } else {
            $conexion = $conexion::getInstance();
            $this->pdo = $conexion->getInstance;
        }
    }

    function ejecutaSQL($sql, $datos = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($datos);

        return $stmt;
    }

    /**
     * Get the value of pdo
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @return  self
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}