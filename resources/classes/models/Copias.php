<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;
use PDO;

class Copias extends Model
{

    private $cantidad;
    private $isbn = null;
    private $estado;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "CALL insertarCopias('$this->isbn', $this->cantidad);";

        return $this->intermediario->ejecutaSQL($sql);
    }

    public function obtener(string | null $id): Model | bool
    {
        if ($id === null) {
            return false;
        }

        $sql = "SELECT * FROM v_copias WHERE codigo = :codigo";
        $stmt = $this->intermediario->ejecutaSQL($sql, ["codigo" => $id]);

        $copia = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $copia;
    }

    public function obtenerTodos()
    {
        $copias = [];

        if ($this->isbn === null) {
            $sql = "SELECT * FROM v_copias";
            $stmt = $this->intermediario->ejecutaSQL($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM v_copias WHERE isbn = :isbn";
            $stmt = $this->intermediario->ejecutaSQL($sql, ["isbn" => $this->isbn]);

            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($lista as $copia) {
            $copias[] = $this->crearDesdeArray($copia);
        }
        return $copias;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `copias` SET `estado`=:estado WHERE `codigo` = :codigo";
        $valores = ["estado" => $this->getEstado(), "codigo" => $this->getId()];

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["codigo"] = $this->id;
        }

        $datos += [
            "isbn" => $this->isbn,
            "estado" => $this->estado,
            "cantidad" => $this->cantidad
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $devolucion = new Copias($this->intermediario);
        $devolucion->setIsbn($array["isbn"])
            ->setEstado($array["estado"])
            ->setCantidad($array["cantidad"]);

        if (isset($array["codigo"])) {
            $devolucion->setId($array["codigo"]);
        }
        return $devolucion;
    }

    public function jsonSerialize(): mixed
    {

        return $this->datosComoArray();
    }

    /* *************************************************************** Getters y Setters ************************************************************** */


    /**
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set the value of isbn
     *
     * @return  self
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}