<?php

class Usuario
{
    private $nombre;
    private $codigo;
    private $email;
    private $contrasenia;
    private $telefono;
    private $estado = 1;

    function __construct($nombre, $codigo, $email, $contrasenia, $telefono)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->telefono = $telefono;
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
}