<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once "./interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */
class tipoDeLibro implements IMostrable
{
    private $nombre;
    private $descripcion;

    function __construct($nombre, $descripcion)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function datosComoArray(): array
    {
        $retorno = array(
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion
        );

        return $retorno;
    }
}