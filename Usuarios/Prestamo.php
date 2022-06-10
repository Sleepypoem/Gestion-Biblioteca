<?php
class Prestamo
{
    //aqui irian mas atributos dependiendo de la base de datos.
    private $inicio;
    private $final;
    private $estado;

    public function __construct()
    {
        $this->inicio = new DateTime();
        $this->final = $this->inicio->modify("+1 week");
        $this->estado = 1;
    }

    /**
     * Get the value of inicio
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Get the value of final
     */
    public function getFinal()
    {
        return $this->final;
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