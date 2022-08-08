<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Autor extends Model
{
    private $nombre;
    private $fechaNacimiento;
    private $imagen;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `autor`(`nombre`, `fechaNacimiento`, `image`) VALUES (
            :nombre, :fechaNacimiento, :image)";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {

        $sql = "SELECT * FROM `autor` WHERE `idAutor` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $autor = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $autor;
    }

    public function obtenerTodos()
    {
        $autores = [];
        $sql = "SELECT * FROM `autor`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $autores[] = $this->crearDesdeArray($entrada);
        }

        return $autores;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `autor` SET `nombre`=:nombre,`fechaNacimiento`=:fechaNacimiento,`image`= :image WHERE `idAutor` = :id";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["idAutor"] = $this->id;
        }

        $datos += [
            "nombre" => $this->nombre,
            "fechaNacimiento" => $this->fechaNacimiento,
            "image" => $this->imagen
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $autor = new Autor($this->intermediario);
        $autor->setNombre($array["nombre"])
            ->setFechaNacimiento($array["fechaNacimiento"])
            ->setImagen($array["image"]);

        if (isset($array["idAutor"])) {
            $autor->setId($array["idAutor"]);
        }
        return $autor;
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
     * Get the value of fechaNacimiento
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set the value of fechaNacimiento
     *
     * @return  self
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
}