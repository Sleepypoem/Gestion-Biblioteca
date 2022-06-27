<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once INTERFACES . "/IGestor.php";
require_once VIEWS . "/CrearAlertas.php";
/* ************************************************************************************************************************************************ */

class GestorDePrestamos implements IGestor
{
    private $intermediario;
    private $codigoLector;
    private $isbn;
    private $fechaDeHoy;
    private $copiasDisponibles = [];
    private $alertas;

    function __construct($codigoLector, $codigoBibliotecario, $isbn, $intermediario = null)
    {
        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }

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
        $estado = $this->comunicarseConBD($sql);
        if ($estado[0]["estado"] == 1) {
            $sql = "SELECT COUNT(0) as prestamos FROM prestamo WHERE codigoLector = $this->codigoLector AND estado = 1";
            $numeroDePrestamos = $this->comunicarseConBD($sql)[0]["prestamos"];
            if ($numeroDePrestamos < 3) {
                return true;
            }
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

    /**
     * Le añade 4 semanas a la fecha actual para calcular la fecha de devolucion.
     *
     * @return string La fecha de hoy mas 4 semanas.
     */
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
     * Se encarga de todo lo relacionado con el prestamo en la base de datos con los datos
     * pasados al constructor y devuelve un mensaje dependiendo del resultado.
     *
     * @return void
     */
    public function prestar()
    {
        if (!$this->comprobarUsuario()) {
            return $this->alertas->crearAlertaFallo("Este usuario no puede prestar mas libros!");
        }

        if ($this->comprobarCopias() == 0) {
            return $this->alertas->crearAlertaFallo("Lo sentimos, no hay mas copias de este libro.");
        }

        $this->registrarPrestamo();
        $this->actualizarLaCopia();
        $this->copiasDisponibles = [];
        return $this->alertas->crearAlertaExito("Se registro el prestamo");
    }

    function comunicarseConBD($sql): array
    {
        return $this->intermediario->ejecutarSQL($sql);
    }
}