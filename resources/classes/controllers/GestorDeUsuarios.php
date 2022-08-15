<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Usuario as Usuario;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;
use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;
use Alexander\Biblioteca\classes\models\Bibliotecario;
use Alexander\Biblioteca\classes\models\Lector;
use PDO;

/* ************************************************************************************************************************************************ */

class GestorDeUsuarios implements Gestor, IValidar
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

        $manejadorDeImg = new ManejadordeImagenes();
        $imagen = $manejadorDeImg->crear(["imagen" => $data["imagen"]]);

        if ($imagen === false) {
            $data["imagen"] = "default.png";
        } else {
            $data["imagen"] = $imagen;
        }

        $usuarioTemp = new Usuario($this->intermediario);
        $usuarioTemp = $usuarioTemp->crearDesdeArray($data);

        $usuarioTemp = $usuarioTemp->guardar();
        if ($usuarioTemp != false) {
            $pdo = $this->intermediario->getPdo();
            $id = $pdo->lastInsertId();

            if ($data["rol"] === "bibliotecario") {
                $bibliotecario = new Bibliotecario($this->intermediario);
                $bibliotecario->setId($id);
                $bibliotecario->setRol($data["rol"]);
                $bibliotecario->guardar();
            } else if ($data["rol"] === "lector") {
                $lector = new Lector($this->intermediario);
                $lector->setId($id);
                $lector->guardar();
            } else {
                return false;
            }
        }

        return $usuarioTemp;
    }

    public function leer($id = null)
    {
        $usuarioTemp = new Usuario($this->intermediario);

        if ($id === null || $id === "") {
            $usuarioTemp = $usuarioTemp->obtenerTodos();
        } else {
            $usuarioTemp = $usuarioTemp->obtener($id);
        }

        if (is_bool($usuarioTemp)) {
            return false;
        }

        return $usuarioTemp;
    }

    public function actualizar($id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $usuarioTemp = new Usuario($this->intermediario);
        $usuarioTemp = $usuarioTemp->crearDesdeArray($data);


        $usuarioTemp =  $usuarioTemp->actualizar($id);
        return $usuarioTemp;
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