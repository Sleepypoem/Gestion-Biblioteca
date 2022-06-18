<?php

/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Organizacion-prueba/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
/* ************************************************************************************************************************************************ */

class GestorDeDevoluciones implements IGestor
{
    private $intermediario;
    private $idPrestamo;
    private $codigoCopia;
    private $codigoBibliotecario;

    function __construct($codigoCopia)
    {
        $this->intermediario = new Intermediario();
        $this->codigoCopia = $codigoCopia;
        echo $this->consultarPrestamo();
    }

    /**
     * Registra la devolucion en la base de datos, actualiza los estados de la copia y el prestamo.
     *
     * @return string Un mensaje de confirmacion.
     */
    public function devolver()
    {
        $sql = "UPDATE prestamo SET estado = 2 WHERE idPrestamo = $this->idPrestamo";
        $this->comunicarseConBD($sql);
        $this->actualizarLaCopia();
        $this->registrarDevolucion();

        return "Libro devuelto con exito";
    }

    private function consultarPrestamo()
    {
        $sql = "SELECT idPrestamo, codigoLector, codigoBbliotecario FROM prestamo WHERE codigo_copia = $this->codigoCopia";
        $resultados = $this->comunicarseConBD($sql);

        if ($resultados == []) {
            return "No se encontro ningun prestamo asociado a esta copia";
        } else {
            $this->idPrestamo = $resultados[0]["idPrestamo"];
            $this->codigoBibliotecario = $resultados[0]["codigoBbliotecario"];
        }
    }

    private function registrarDevolucion()
    {
        $sql = "INSERT INTO devolucion (idPrestamo, idBbliotecario) VALUES ($this->idPrestamo,$this->codigoBibliotecario)";
        $this->comunicarseConBD($sql);
    }

    private function actualizarLaCopia()
    {
        $sql = "UPDATE copias SET estado = 1 WHERE codigo = $this->codigoCopia";
        $this->comunicarseConBD($sql);
    }

    function comunicarseConBD($sql): array
    {
        $resultados = $this->intermediario->ejecutarSQL($sql);
        return $resultados;
    }
}