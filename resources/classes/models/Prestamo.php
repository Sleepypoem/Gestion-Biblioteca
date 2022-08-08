<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Prestamo extends Model
{

    private $fechaPrestamo;
    private $fechaDevolucion;
    private $codigoLector;
    private $codigoBibliotecario;
    private $codigoCopia;
    private $estado;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `prestamo`(`fechaPrestamo`, `fechaDevolucion`, `codigoLector`, `codigoBbliotecario`, `codigo_copia`, `estado`) VALUES 
        ( :fechaPrestamo , :fechaDevolucion , :codigoLector , :codigoBbliotecario , :codigo_copia , :estado )";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {
        if ($id === null) {
            return false;
        }

        $sql = "SELECT * FROM `prestamo` WHERE `idPrestamo` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $prestamo = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $prestamo;
    }

    public function obtenerTodos()
    {
        $prestamos = [];
        $sql = "SELECT * FROM `prestamo`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $prestamos[] = $this->crearDesdeArray($entrada);
        }

        return $prestamos;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `prestamo` SET `fechaPrestamo`= :fechaPrestamo ,`fechaDevolucion`= :fechaDevolucion ,`codigoLector`= :codigoLector ,
        `codigoBbliotecario`= :codigoBbliotecario ,`codigo_copia`=:codigoCopia,`estado`= :estado  WHERE `idPrestamo` = :id";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["idPrestamo"] = $this->id;
        }

        $datos += [

            "fechaPrestamo" => $this->fechaPrestamo,
            "fechaDevolucion" => $this->fechaDevolucion,
            "codigoLector" => $this->codigoLector,
            "codigoBbliotecario" => $this->codigoBibliotecario,
            "codigo_copia" => $this->codigoCopia,
            "estado" => $this->estado
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $prestamo = new Prestamo($this->intermediario);
        $prestamo->setFechaPrestamo($array["fechaPrestamo"])
            ->setFechaDevolucion($array["fechaDevolucion"])
            ->setCodigoLector($array["codigoLector"])
            ->setCodigoBibliotecario($array["codigoBbliotecario"])
            ->setCodigoCopia($array["codigo_copia"])
            ->setEstado($array["estado"]);

        if (isset($array["idPrestamo"])) {
            $prestamo->setId($array["idPrestamo"]);
        }

        return $prestamo;
    }

    public function jsonSerialize(): mixed
    {

        return $this->datosComoArray();
    }
    /* *************************************************************** Getters y Setters ************************************************************** */



    /**
     * Get the value of fechaPrestamo
     */
    public function getFechaPrestamo()
    {
        return $this->fechaPrestamo;
    }

    /**
     * Set the value of fechaPrestamo
     *
     * @return  self
     */
    public function setFechaPrestamo($fechaPrestamo)
    {
        $this->fechaPrestamo = $fechaPrestamo;

        return $this;
    }

    /**
     * Get the value of fechaDevolucion
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * Set the value of fechaDevolucion
     *
     * @return  self
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;

        return $this;
    }

    /**
     * Get the value of codigoLector
     */
    public function getCodigoLector()
    {
        return $this->codigoLector;
    }

    /**
     * Set the value of codigoLector
     *
     * @return  self
     */
    public function setCodigoLector($codigoLector)
    {
        $this->codigoLector = $codigoLector;

        return $this;
    }

    /**
     * Get the value of codigoBibliotecario
     */
    public function getCodigoBibliotecario()
    {
        return $this->codigoBibliotecario;
    }

    /**
     * Set the value of codigoBibliotecario
     *
     * @return  self
     */
    public function setCodigoBibliotecario($codigoBibliotecario)
    {
        $this->codigoBibliotecario = $codigoBibliotecario;

        return $this;
    }

    /**
     * Get the value of codigoCopia
     */
    public function getCodigoCopia()
    {
        return $this->codigoCopia;
    }

    /**
     * Set the value of codigoCopia
     *
     * @return  self
     */
    public function setCodigoCopia($codigoCopia)
    {
        $this->codigoCopia = $codigoCopia;

        return $this;
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

        return $this;
    }
}