<?php

/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
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
     * Se encarga de todo lo relacionado a la devolucion en la base de datos,
     * actualiza los estados de la copia y el prestamo.
     *
     * @return string Un mensaje de confirmacion.
     */
    public function devolver()
    {
        $sql = "UPDATE prestamo SET estado = 2 WHERE idPrestamo = $this->idPrestamo";
        $this->comunicarseConBD($sql);

        $this->registrarDevolucion();
        $this->actualizarLaCopia();

        return "Libro devuelto con exito";
    }

    /**
     * Consulta la informacion de prestamo de una copia en especifico.
     *
     * @return void
     */
    private function consultarPrestamo()
    {
        $sql = "SELECT idPrestamo, codigoLector, codigoBbliotecario FROM prestamo WHERE codigo_copia = $this->codigoCopia AND estado = 1;";
        $resultados = $this->comunicarseConBD($sql);
        if ($resultados == []) {
            return "No se encontro ningun prestamo asociado a esta copia";
        } else {
            $this->idPrestamo = $resultados[0]["idPrestamo"];
            $this->codigoBibliotecario = $resultados[0]["codigoBbliotecario"];
        }
    }

    /**
     * Registra la devolucion en la base de dato, para dejar registro.
     *
     * @return void
     */
    private function registrarDevolucion()
    {
        $sql = "INSERT INTO devolucion (idPrestamo, idBbliotecario) VALUES ($this->idPrestamo, $this->codigoBibliotecario)";
        echo $sql;
        $this->comunicarseConBD($sql);
    }

    /**
     * Actualiza el estado de la copia en la base de datos a "1" que significa que ya esta disponible para volver a prestar.
     *
     * @return void
     */
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