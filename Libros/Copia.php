<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once SITE_ROOT . "/interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */
class Copia
{
    private $isbn;
    private $estado;

    function __construct($isbn)
    {
        $this->isbn = $isbn;
        $this->estado = 1;
    }

    /**
     * Get the value of isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function datosComoArray(): array
    {
        $retorno = array(
            "isbn" => $this->isbn,
            "estado" => $this->estado
        );

        return $retorno;
    }
}