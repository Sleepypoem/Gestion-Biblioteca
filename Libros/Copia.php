<?php

class Copia
{
    private $id, $estado;

    function __construct($id, $estado)
    {
        $this->id = $id;
        $this->estado = $estado;
    }

    /**
     * Devuelve el valor de $id
     * @return string El id del libro.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Devuelve el estado.
     * @return string El estado del libro.
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Cambia el estado.
     *
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}