<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once "./interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */

class Autor implements IMostrable
{
    private $nombre;
    private $fechaNacimiento;
    private $imagen;

    function __construct($nombre, $fechaNacimiento, $imagen)
    {
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->imagen = $imagen;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function datosComoArray(): array
    {
        $retorno = array(
            "nombre" => $this->nombre,
            "fechaDeNacimiento" => $this->fechaDeNacimiento,
            "imagen" => $this->imagen
        );

        return $retorno;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
}