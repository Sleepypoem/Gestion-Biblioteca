<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\interfaces\IGestor as IGestor;
use Alexander\Biblioteca\classes\views\CrearAlertas as CrearAlertas;

use Exception;
/* ************************************************************************************************************************************************ */

class GestorDeDevoluciones implements IGestor
{
    private $intermediario;
    private $idPrestamo;
    private $codigoCopia;
    private $codigoBibliotecario;
    private $alertas;

    function __construct($codigoCopia, $intermediario = null)
    {
        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }

        $this->codigoCopia = $codigoCopia;
        $this->consultarPrestamo();
    }

    /**
     * Se encarga de todo lo relacionado a la devolucion en la base de datos,
     * actualiza los estados de la copia y el prestamo.
     *
     * @return string Un mensaje de confirmacion o de fallo.
     */
    public function devolver()
    {
        $prestamo = $this->consultarPrestamo();
        if ($prestamo == []) {
            return $this->alertas->crearAlertaFallo("No se encontro prestamo registrado a esta copia.");
        } else {
            $this->idPrestamo = $prestamo[0]["idPrestamo"];
            $this->codigoBibliotecario = $prestamo[0]["codigoBbliotecario"];
        }

        $sql = "UPDATE prestamo SET estado = 2 WHERE idPrestamo = $this->idPrestamo";
        if (!$this->comunicarseConBD("ejecutar", $sql)) {
            return $this->alertas->crearAlertaFallo("Error al registrar el prestamo");
        }
        $this->registrarDevolucion();
        $this->actualizarLaCopia();

        return $this->alertas->crearAlertaExito("Se registro la devolucion.");
    }

    /**
     * Consulta la informacion de prestamo de una copia en especifico.
     *
     * @return void
     */
    private function consultarPrestamo(): array
    {
        $resultados = [];
        $sql = "SELECT idPrestamo, codigoLector, codigoBbliotecario FROM prestamo WHERE codigo_copia = $this->codigoCopia AND estado = 1;";
        $resultados = $this->comunicarseConBD("consultar", $sql);
        return $resultados;
    }

    /**
     * Registra la devolucion en la base de dato, para dejar registro.
     *
     * @return void
     */
    private function registrarDevolucion()
    {
        $sql = "INSERT INTO devolucion (idPrestamo, idBbliotecario) VALUES ($this->idPrestamo, $this->codigoBibliotecario)";
        return $this->comunicarseConBD("ejecutar", $sql);
    }

    /**
     * Actualiza el estado de la copia en la base de datos a "1" que significa que ya esta disponible para volver a prestar.
     *
     * @return void
     */
    private function actualizarLaCopia()
    {
        $sql = "UPDATE copias SET estado = 1 WHERE codigo = $this->codigoCopia";
        return $this->comunicarseConBD("ejecutar", $sql);
    }

    function comunicarseConBD($tipo, $sql)
    {
        if ($tipo === "ejecutar") {
            return $this->intermediario->insertarEnBD($sql);
        } else if ($tipo === "consultar") {
            return $this->intermediario->consultarConBD($sql);
        } else {
            throw new Exception("Error de tipo");
        }
    }
}