<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once CONTROLLERS . "/Intermediario.php";
require_once VIEWS . "/CrearAlertas.php";
/* ************************************************************************************************************************************************ */

class GestorDeMultas
{
    private $intermediario;
    private $fechadeHoy;
    private $tarifa = 0.50;
    private $alertas;

    function __construct(Intermediario $intermediario)
    {
        $this->alertas = new CrearAlertas();
        $this->intermediario = $intermediario;
        $this->fechadeHoy = new DateTime();
    }

    public function revisarMulta()
    {
        $sql = "SELECT * FROM `prestamo` WHERE `fechaDevolucion` < CURRENT_TIMESTAMP;";
        $listaMultas = $this->intermediario->ejecutarSQL("prestamo", $sql);
        if (count($listaMultas) > 1) {
            foreach ($listaMultas as $multa) {
                $this->multar($this->tarifa, $listaMultas["codigoLector"]);
            }
        }
    }

    private function multar($monto, $codigoLector)
    {
        $sql = "INSERT INTO multa (codigoLector, monto) VALUES ('$codigoLector', '$monto')";
        $this->intermediario->insertarEnBD($sql);
    }

    public function recalcularMonto($diasTranscurridos, $id)
    {
        $sql = "SELECT monto FROM multa WHERE id = $id";
        $montoActual = $this->intermediario->ejecutarSQL($sql)["monto"];
        for ($iterador = 0; $iterador < $diasTranscurridos; $iterador++) {
            $nuevoMonto = $montoActual += $this->tarifa;
        }

        $sql = "UPDATE multa SET monto = $nuevoMonto WHERE id = $id";
        $this->intermediario->ejecutarSQL($sql);
    }
}