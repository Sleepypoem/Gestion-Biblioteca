<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Bibliotecario extends Model
{

    private $rol;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `bibliotecario`(`codigoBbliotecario`, `rol`) VALUES (:codigoBbliotecario, :rol)";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {

        $sql = "SELECT * FROM `bibliotecario` WHERE `codigoBbliotecario` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $autor = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $autor;
    }

    public function obtenerTodos()
    {
        $autores = [];
        $sql = "SELECT * FROM `bibliotecario`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $autores[] = $this->crearDesdeArray($entrada);
        }

        return $autores;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `bibliotecario` SET `codigoBbliotecario`= :codigoBbliotecario WHERE `codigoBbliotecario` = :id";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [
            "codigoBbliotecario" => $this->id,
            "rol" => $this->rol
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        $bibliotecario = new bibliotecario($this->intermediario);
        $bibliotecario->setId($array["codigoBbliotecario"])
            ->setRol($array["rol"]);

        return $bibliotecario;
    }

    public function jsonSerialize(): mixed
    {
        return $this->datosComoArray();
    }

    /* *************************************************************** Getters y Setters ************************************************************** */

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}