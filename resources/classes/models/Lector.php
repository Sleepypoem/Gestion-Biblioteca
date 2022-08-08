<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Lector extends Model
{

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `lector`(`codigoLector`) VALUES (:codigoLector)";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {

        $sql = "SELECT * FROM `lector` WHERE `codigoLector` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $autor = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $autor;
    }

    public function obtenerTodos()
    {
        $autores = [];
        $sql = "SELECT * FROM `lector`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $autores[] = $this->crearDesdeArray($entrada);
        }

        return $autores;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `lector` SET `codigoLector`= :codigoLector WHERE `codigoLector` = :id";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos["codigoLector"] = $this->id;

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        $lector = new Lector($this->intermediario);
        $lector->setId($array["codigoLector"]);

        return $lector;
    }

    public function jsonSerialize(): mixed
    {
        return $this->datosComoArray();
    }
}