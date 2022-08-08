<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Prestamo as Prestamo;
use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;
use Alexander\Biblioteca\classes\models\Copias as Copias;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;

/* ************************************************************************************************************************************************ */

class GestorDePrestamos implements Gestor, IValidar
{
    private $intermediario;

    function __construct()
    {
        $this->intermediario = new Intermediario();
    }

    public function crear(array $data)
    {
        $copiaTemp = new Copias($this->intermediario);

        if (!$this->validar($data)) {
            return false;
        }

        $prestamoTemp = new Prestamo($this->intermediario);
        $prestamoTemp = $prestamoTemp->crearDesdeArray($data);

        if ($prestamoTemp->guardar()) {
            $copiaTemp = $copiaTemp->obtener($data["codigoCopia"]);
            $copiaTemp->setEstado(2);
            $copiaTemp->actualizar($copiaTemp->getId());
            return true;
        } else {
            return false;
        }
    }

    public function leer(int $id = null)
    {
        $prestamoTemp = new Prestamo($this->intermediario);

        if ($id === null || $id === "") {
            $prestamoTemp = $prestamoTemp->obtenerTodos();
        } else {
            $prestamoTemp = $prestamoTemp->obtener($id);
        }
        return $prestamoTemp;
    }

    public function actualizar(int $id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $prestamoTemp = new Prestamo($this->intermediario);
        $prestamoTemp = $prestamoTemp->crearDesdeArray($data);

        return $prestamoTemp->actualizar($id);
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