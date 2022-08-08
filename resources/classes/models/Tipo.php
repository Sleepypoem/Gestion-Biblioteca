<?php

namespace Alexander\Biblioteca\classes\models;

use Alexander\Biblioteca\classes\models\Model as Model;
use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;

use PDO;

class Tipo extends Model
{

    private $nombre;
    private $descripcion;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `tipos-de-libros`( `nombre`, `descripcion`) VALUES 
        ( :nombre , :descripcion )";

        $valores = $this->datosComoArray();
        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {
        if ($id === null) {
            return false;
        }

        $sql = "SELECT * FROM `tipos-de-libros` WHERE `idtipoLibro` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $devolucion = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $devolucion;
    }

    public function obtenerTodos()
    {
        $devoluciones = [];
        $sql = "SELECT * FROM `tipos-de-libros`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $devoluciones[] = $this->crearDesdeArray($entrada);
        }

        return $devoluciones;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `tipos-de-libros` SET `nombre`= :nombre ,`descripcion`= :descripcion  WHERE `idtipoLibro` = :idtipoLibro";

        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["idtipoLibro"] = $this->id;
        }

        $datos += [
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $devolucion = new Tipo($this->intermediario);
        $devolucion->setNombre($array["nombre"])
            ->setDescripcion($array["descripcion"]);

        if (isset($array["idtipoLibro"])) {
            $devolucion->setId($array["idtipoLibro"]);
        }
        return $devolucion;
    }

    public function jsonSerialize(): mixed
    {

        return $this->datosComoArray();
    }
    /* *************************************************************** Getters y Setters ************************************************************** */

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}