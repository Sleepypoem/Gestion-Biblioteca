<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Devolucion as Devolucion;
use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;
use Alexander\Biblioteca\classes\models\Copias as Copias;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;

/* ************************************************************************************************************************************************ */

class GestorDeDevoluciones implements Gestor, IValidar
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

        $devolucionTemp = new Devolucion($this->intermediario);
        $devolucionTemp = $devolucionTemp->crearDesdeArray($data);

        if ($devolucionTemp->guardar()) {
            $copiaTemp = $copiaTemp->obtener($data["codigoCopia"]);
            $copiaTemp->setEstado(1);
            $copiaTemp->actualizar($copiaTemp->getId());
            return true;
        } else {
            return false;
        }
    }

    public function leer(int $id = null)
    {
        $devolucionTemp = new Devolucion($this->intermediario);

        if ($id === null || $id === "") {
            $devolucionTemp = $devolucionTemp->obtenerTodos();
        } else {
            $devolucionTemp = $devolucionTemp->obtener($id);
        }

        if (is_bool($devolucionTemp)) {
            return false;
        }
        return $devolucionTemp;
    }

    public function actualizar(int $id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $devolucionTemp = new Devolucion($this->intermediario);
        $devolucionTemp = $devolucionTemp->crearDesdeArray($data);

        $devolucionTemp = $devolucionTemp->actualizar($id);
        return $devolucionTemp;
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