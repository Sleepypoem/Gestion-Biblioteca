<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Devolucion extends Model
{

    private $idPrestamo;
    private $idBibliotecario;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `devolucion`(`idPrestamo`, `idBbliotecario`) VALUES (:idPrestamo, :idBbliotecario)";

        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {
        if ($id === null) {
            return false;
        }

        $sql = "SELECT * FROM `devolucion` WHERE `idDevolucion` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $devolucion = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $devolucion;
    }

    public function obtenerTodos()
    {
        $devoluciones = [];
        $sql = "SELECT * FROM `devolucion`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $devoluciones[] = $this->crearDesdeArray($entrada);
        }

        return $devoluciones;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `devolucion` SET`idPrestamo`=:idPrestamo,`idBbliotecario`=:idBibliotecario WHERE `idDevolucion` = :idDevolucion";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["idDevolucion"] = $this->id;
        }

        $datos += [
            "idPrestamo" => $this->idPrestamo,
            "idBbliotecario" => $this->idBibliotecario
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $devolucion = new Devolucion($this->intermediario);
        $devolucion->setIdPrestamo($array["idPrestamo"])
            ->setIdBibliotecario($array["idBbliotecario"]);

        if (isset($array["idDevolucion"])) {
            $devolucion->setId($array["idDevolucion"]);
        }
        return $devolucion;
    }

    public function jsonSerialize(): mixed
    {

        return $this->datosComoArray();
    }
    /* *************************************************************** Getters y Setters ************************************************************** */



    /**
     * Get the value of idPrestamo
     */
    public function getIdPrestamo()
    {
        return $this->idPrestamo;
    }

    /**
     * Set the value of idPrestamo
     *
     * @return  self
     */
    public function setIdPrestamo($idPrestamo)
    {
        $this->idPrestamo = $idPrestamo;

        return $this;
    }

    /**
     * Get the value of idBibliotecario
     */
    public function getIdBibliotecario()
    {
        return $this->idBibliotecario;
    }

    /**
     * Set the value of idBibliotecario
     *
     * @return  self
     */
    public function setIdBibliotecario($idBibliotecario)
    {
        $this->idBibliotecario = $idBibliotecario;

        return $this;
    }
}