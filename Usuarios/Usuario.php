<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once SITE_ROOT . "/interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */
class Usuario implements IMostrable
{
    private $nombre;
    private $codigo;
    private $email;
    private $direccion;
    private $contrasenia;
    private $telefono;
    private $imagen;
    private $estado = 1;

    function __construct($nombre, $codigo, $direccion, $email, $contrasenia, $telefono, $imagen)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->contrasenia = $contrasenia;
        $this->telefono = $telefono;
        $this->imagen = $imagen;
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
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of contrasenia
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * Set the value of contrasenia
     *
     * @return  self
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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
            "nombre" => $this->nombre,
            "codigo" => $this->codigo,
            "email" => $this->email,
            "direccion" => $this->direccion,
            "contrasenia" => $this->contrasenia,
            "telefono" => $this->telefono,
            "estado" => $this->estado,
            "imagen" => $this->imagen
        );

        return $retorno;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
}