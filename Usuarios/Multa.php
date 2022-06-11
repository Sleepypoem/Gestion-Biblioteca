<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once "./interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */
class Multa implements IMostrable
{
    private $monto = 0;
    private $fechaDevolucion;
    private $tarifa;

    function __construct(DateTime $fechaDevolucion, $tarifa)
    {
        $this->fechaDevolucion = $fechaDevolucion;
        $this->tarifa = $tarifa;
    }

    public function recalcularMonto()
    {
        $fechaHoy = new DateTime();
        $diasTranscurridos = $fechaHoy->diff($this->fechaDevolucion);

        for ($iterador = 0; $iterador < $diasTranscurridos; $iterador++) {
            $this->monto += $this->tarifa;
        }
    }

    /**
     * Get the value of monto
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Get the value of tarifa
     */
    public function getTarifa()
    {
        return $this->tarifa;
    }

    /**
     * Set the value of tarifa
     *
     * @return  self
     */
    public function setTarifa($tarifa)
    {
        $this->tarifa = $tarifa;
    }

    public function datosComoArray(): array
    {
        $retorno = array(
            "monto" => $this->monto,
            "fechaDevolucion" => $this->fechaDevolucion,
            "tarifa" => $this->tarifa
        );

        return $retorno;
    }
}