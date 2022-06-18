<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
/* ************************************************************************************************************************************************ */

class GestorDeCategorias implements IGestor
{
    private $intermediario;
    private $nombre;
    private $descripcion = "sin descripcion";

    function __construct($nombre, $descripcion)
    {
        $this->intermediario = new Intermediario();
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function agregarCategoria()
    {
        if (!$this->validarCampo($this->nombre)) {
            return "El nombre no puede estar vacio";
        } else {
            $sql = "INSERT INTO `tipos-de-libros` (nombre, descripcion) VALUES ('$this->nombre', '$this->descripcion')";
            $this->comunicarseConBD($sql);

            return "Categoria añadida exitosamente";
        }
    }

    private function validarCampo($entrada)
    {
        if ($entrada == "" || $entrada == null) {
            return false;
        }

        return true;
    }

    function comunicarseConBD($sql): array
    {
        return $this->intermediario->ejecutarSQL($sql);
    }
}