<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;
use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;
use Alexander\Biblioteca\classes\models\Autor as Autor;
/* ************************************************************************************************************************************************ */

class GestorDeAutores implements Gestor, IValidar
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

        $autorTemp = new Autor($this->intermediario);
        $autorTemp = $autorTemp->crearDesdeArray($data);

        $autorTemp = $autorTemp->guardar();

        return $autorTemp;
    }

    public function leer(int $id = null)
    {
        $autorTemp = new Autor($this->intermediario);
        if ($id === null || $id === "") {
            $autorTemp = $autorTemp->obtenerTodos();
        } else {
            $autorTemp = $autorTemp->obtener($id);
        }

        if (!is_array($autorTemp)) {
            return false;
        }

        return $autorTemp;
    }

    public function actualizar(int $id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $autorTemp = new Autor($this->intermediario);
        $autorTemp = $autorTemp->crearDesdeArray($data);

        $autorTemp = $autorTemp->actualizar($id);

        return $autorTemp;
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