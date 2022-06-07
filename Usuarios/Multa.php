<?php
class Prestamo
{
    //aqui irian mas atributos dependiendo de la base de datos.
    protected $inicio;
    protected $final;

    public function __construct($ini, $fin)
    {
        $this->inicio = date($ini);
        $this->final = date($fin);
    }

    #funcion_multa
    public function Multa($Fecha)
    {
        $Fecha_Devolucion = date($Fecha);
        if ($Fecha_Devolucion > $this->final) {
            echo "Tiene una multa pendiente";
        } else {
            echo "el prestamo no acumula multa";
        }
    }
}