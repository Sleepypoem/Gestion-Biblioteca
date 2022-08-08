<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\interfaces\IValidar;
use JsonSerializable;

abstract class Model implements JsonSerializable, IValidar
{
    protected $id = null;
    protected $intermediario;

    /**
     * Guarda el objeto en la base de datos.
     *
     * @return PDOStatement|bool 
     */
    public abstract function guardar();

    /**
     * Obtiene datos de la base de datos con el id proporcionado.
     *
     * @param string $id el id del elemento a buscar.
     * @return Model|bool retorna un objeto creado si tiene exito, false si no.
     */
    public abstract function obtener(string $id): Model | bool;

    /**
     * Obtiene una lista de todos los valores de una tabla en la base de datos.
     *
     * @return array|bool un array de objetos si tiene exito, false si no.
     */
    public abstract function obtenerTodos();

    /**
     * Actualiza un valor en la base de datos con el id proporcionado.
     *
     * @param string $id
     * @return PDOStatement|bool
     */
    public abstract function actualizar(string $id);

    /**
     * Obtiene los datos de esta clase en forma de un array asociativo.
     *
     * @return array
     */
    public abstract function datosComoArray();

    /**
     * Crea un objeto del tipo Model con el array proporcionado.
     *
     * @param array $array
     * @return Model|bool Retorna un objeto del tipo Model si tiene exito, false si no.
     */
    public abstract function crearDesdeArray(array $array);

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    function validar($entrada)
    {
        if (is_bool($entrada)) {
            return false;
        }

        foreach ($entrada as $valor) {
            if ($valor === null || $valor === "") {
                return false;
            }
        }

        return true;
    }
}