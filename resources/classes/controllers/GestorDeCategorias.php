<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Tipo as Tipo;
use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;
/* ************************************************************************************************************************************************ */

class GestorDeCategorias implements Gestor, IValidar
{
    private $intermediario;

    function __construct()
    {
        $this->intermediario = new Intermediario();
    }

    public function crear(array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $categoriaTemp = new Tipo($this->intermediario);
        $categoriaTemp = $categoriaTemp->crearDesdeArray($data);

        return $categoriaTemp->guardar();
    }

    public function leer(int $id = null)
    {
        $categoriaTemp = new Tipo($this->intermediario);

        if ($id === null || $id === "") {
            $categoriaTemp = $categoriaTemp->obtenerTodos();
        } else {
            $categoriaTemp = $categoriaTemp->obtener($id);
        }
        return $categoriaTemp;
    }

    public function actualizar(int $id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $categoriaTemp = new Tipo($this->intermediario);
        $categoriaTemp = $categoriaTemp->crearDesdeArray($data);

        return $categoriaTemp->actualizar($id);
    }

    function validar($entrada)
    {
        foreach ($entrada as $valor) {
            $valor = trim($valor);
            if ($valor == "") {
                return false;
            }
        }

        return true;
    }
}