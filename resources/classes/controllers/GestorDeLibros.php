<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\models\Libro as Libro;
use Alexander\Biblioteca\classes\models\Autor as Autor;
use Alexander\Biblioteca\classes\models\Tipo as Tipo;
use Alexander\Biblioteca\classes\interfaces\IGestor;
use Alexander\Biblioteca\classes\models\Copias as Copias;
use Alexander\Biblioteca\classes\interfaces\IValidar as Validar;
use Alexander\Biblioteca\classes\models\Model;
use PDOStatement;

/* ************************************************************************************************************************************************ */

class GestorDeLibros implements IGestor, Validar
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

        $libroTemp = new Libro($this->intermediario);
        $libroTemp = $libroTemp->crearDesdeArray($data);

        $libroTemp = $libroTemp->guardar();
        if ($libroTemp != false) {
            $copias = new Copias($this->intermediario);
            $copias->setIsbn($data["isbn"])
                ->setCantidad($data["copias"]);
            $copias->guardar();
        }

        return $libroTemp;
    }

    public function leer(int $id = null)
    {
        $libroTemp = new Libro($this->intermediario);
        $autorTemp = new Autor($this->intermediario);
        $tipoTemp = new Tipo($this->intermediario);
        $copias = new Copias($this->intermediario);

        if ($id === null || $id === "") {
            $libroTemp = $libroTemp->obtenerTodos();
            //si algo salio mal al obtener el libro solo retornamos false, si no modificamos sus parametros para hacerlo mas legible
            if ($libroTemp == false) {
                return false;
            } else {

                foreach ($libroTemp as $libro) {
                    $autorTemp = $autorTemp->obtener($libro->getIdAutor());
                    $tipoTemp = $tipoTemp->obtener($libro->getIdTipoLibro());

                    $libro->setIdAutor($autorTemp->getNombre());
                    $libro->setIdTipoLibro($tipoTemp->getNombre());
                    $copias->setIsbn($libro->getIsbn());
                    $libro->setCopias($copias->obtenerTodos());
                }
            }
        } else {
            $libroTemp = $libroTemp->obtener($id);

            //si algo salio mal al obtener el libro solo retornamos false
            if ($libroTemp == false) {
                return false;
            } else {
                $autorTemp = $autorTemp->obtener($libroTemp->getIdAutor());
                $tipoTemp = $tipoTemp->obtener($libroTemp->getIdTipoLibro());

                $libroTemp->setIdAutor($autorTemp->getNombre());
                $libroTemp->setIdTipoLibro($tipoTemp->getNombre());
                $copias->setIsbn($libroTemp->getIsbn());
                $libroTemp->setCopias($copias->obtenerTodos());
            }
        }

        return $libroTemp;
    }

    public function actualizar(int $id, array $data)
    {
        if (!$this->validar($data)) {
            return false;
        }

        $libroTemp = new Libro($this->intermediario);
        $libroTemp = $libroTemp->crearDesdeArray($data);

        return $libroTemp->actualizar($id);
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