<?php

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
}
