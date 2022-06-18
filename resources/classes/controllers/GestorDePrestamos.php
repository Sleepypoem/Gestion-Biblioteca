<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Organizacion-prueba/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
/* ************************************************************************************************************************************************ */

class GestorDePrestamos implements IGestor
{
    private $intermediario;
    private $codigoLector;
    private $isbn;
    private $fechaDeHoy;
    private $copiasDisponibles = [];

    function __construct($codigoLector, $codigoBibliotecario, $isbn)
    {
        $this->intermediario = new Intermediario();
        $this->fechaDeHoy = new DateTime();
        $this->codigoLector = $codigoLector;
        $this->codigoBibliotecario = $codigoBibliotecario;
        $this->isbn = "'$isbn'";
    }

    /**
     * Revisa si el usuario esta activo para prestar libros.
     *
     * @return bool true si el usuario puede prestar, false si no.
     */
    public function comprobarUsuario()
    {
        $sql = "SELECT `estado` FROM `usuario` WHERE codigo = $this->codigoLector";
        $resultado = $this->intermediario->ejecutarSQL($sql);
        if ($resultado[0]["estado"] == 1) {
            return true;
        }
        return false;
    }

    /**
     * Comprueba la lista de copias disponible y guarda sus codigos en un array.
     *
     * @return int La cantidad de copias disponibles de un libro en concreto.
     */
    public function comprobarCopias()
    {
        $copias = 0;
        $sql = "SELECT * FROM `copias` WHERE isbn = $this->isbn";
        $resultado = $this->ComunicarseConBD($sql);
        foreach ($resultado as $copia) {
            if ($copia["estado"] == 1) {
                $this->copiasDisponibles[] = $copia["codigo"];
                $copias++;
            }
        }

        return $copias;
    }

    private function calcularFechaDeHoy()
    {
        return $this->fechaDeHoy->format("Y-m-d");
    }

    private function calcularFechaDevolucion()
    {
        return $this->fechaDeHoy->modify("+4 week")->format("Y-m-d");
    }

    /**
     * registra el prestamo en la base de datos.
     *
     * @return void
     */
    private function registrarPrestamo()
    {
        $sql = "INSERT INTO prestamo (fechaPrestamo, fechaDevolucion, codigoLector, codigoBbliotecario, codigo_copia, estado) 
        VALUES ('" . $this->calcularFechaDeHoy() . "','" . $this->calcularFechaDevolucion() .
            "', $this->codigoLector , $this->codigoBibliotecario," . $this->copiasDisponibles[0] . ", 1)";

        $this->ComunicarseConBD($sql);
    }

    /** 
     * Cambia el estado de la copia a "prestado".
     * 
     * @return void 
     */
    private function actualizarLaCopia()
    {
        $sql = "UPDATE copias SET estado = 2 WHERE codigo = " . $this->copiasDisponibles[0];
        $this->ComunicarseConBD($sql);
    }

    /**
     * Gestiona el prestamo con los datos pasados al constructor y devuelve un mensaje dependiendo del resultado.
     *
     * @return void
     */
    public function prestar()
    {
        $mensaje = "";

        if (!$this->comprobarUsuario()) {
            $mensaje = "Este usuario no puede prestar mas libros.";
            return $mensaje;
        }

        if ($this->comprobarCopias() == 0) {
            $mensaje = "Lo sentimos, este libro no tiene copias disponibles.";
            return $mensaje;
        }

        $this->registrarPrestamo();
        $this->actualizarLaCopia();
        $mensaje = "Se registro el prestamo.";
        return $mensaje;
    }

    function comunicarseConBD($sql): array
    {
        return $this->intermediario->ejecutarSQL($sql);
    }
}