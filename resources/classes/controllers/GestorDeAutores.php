<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
/* ************************************************************************************************************************************************ */

class GestorDeAutores implements IGestor
{
    private $intermediario;
    private $nombre;
    private $fechaDeNacimiento;
    private $imagen;

    function __construct($nombre, $fechaDeNacimiento)
    {
        $this->intermediario = new Intermediario();
        $this->nombre = $nombre;
        $this->fechaDeNacimiento = $fechaDeNacimiento;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function agregarAutor()
    {
        if (!$this->validarCampo($this->nombre)) {
            return "El nombre no puede estar vacio!";
        }

        $sql = "INSERT INTO `autor`( `nombre`, `fechaNacimiento`, `image`) 
        VALUES ('$this->nombre', '$this->fechaDeNacimiento', '$this->imagen')";
        try {
            #$this->comunicarseConBD($sql);
        } catch (PDOException $e) {
            return "Error al contactarse con la BD. Error: " . $e;
        }

        return "Autor agregado con exito";
    }

    public function editarAutor($id)
    {
        $sql = "UPDATE `autor` SET `nombre`='$this->nombre',`fechaNacimiento`='$this->fechaDeNacimiento',`image`='$this->imagen' WHERE `idAutor` = $id";
        try {
            $this->comunicarseConBD($sql);
        } catch (PDOException $e) {
            return "Error editando el autor. Error: " . $e;
        }

        return "Editado con exito";
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