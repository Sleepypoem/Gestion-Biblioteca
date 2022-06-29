<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONNECTIONS . "/ConexionBD.php";
/* ************************************************************************************************************************************************ */

class Intermediario
{
    private $conexion;
    private $enTransaccion = false;

    function __construct($conexion = null)
    {

        $this->conexion = $conexion == null ? ConexionBD::getInstance() : $conexion;
    }

    /**
     * Obtiene una lista de la base de datos.
     *
     * @param [string] $valor
     * @return array Una lista con los objetos sacados de la base de datos
     */
    public function obtenerDeBD($valor)
    {
        $sql = "SELECT * FROM `$valor`";
        switch ($valor) {
            case 'libro':
                $listaLibros = $this->conexion->consultarBD($sql);
                return $listaLibros;
                break;

            case 'copia':
                $listaCopias = $this->conexion->ejecutaSQL($sql);
                return $listaCopias;
                break;

            case 'autor':
                $listaAutores = $this->conexion->ejecutaSQL($sql);
                return $listaAutores;
                break;

            case 'tipos-de-libros':
                $listaTiposDeLibros = $this->conexion->ejecutaSQL($sql);
                return $listaTiposDeLibros;
                break;

            case 'prestamo':
                $listaPrestamos = $this->conexion->ejecutaSQL($sql);
                return $listaPrestamos;
                break;

            case 'usuario':
                $listaUsuarios = $this->conexion->ejecutaSQL($sql);
                return $listaUsuarios;
                break;

            case 'multa':
                $listaMultas = $this->conexion->ejecutaSQL($sql);
                return $listaMultas;
                break;

            case 'devolucion':
                $listaDevoluciones = $this->conexion->ejecutaSQL($sql);
                return $listaDevoluciones;
                break;

            default:
                throw new Exception("No existen objetos de tipo '" . $valor . "' en la base de datos");

                break;
        }
    }


    /**
     * Inserta valores en su respectiva tabla en la base de datos.
     *
     * @param [string] $sql La sentencia sql a ejecutar para la insercion.
     * @return bool FALSE en caso de error, TRUE en caso de exito.
     */
    public function insertarEnBD($sql)
    {
        return $this->conexion->agregarBD($sql);
    }

    /** 
     * Ejecuta una sentencia sql a la base de datos y retorna el resultado (si lo hay).
     * 
     * @param string $sql   La sentencia a ejecutar.
     * @return array Un array con los resultados.
     */
    public function ejecutarSQL($sql)
    {
        return $this->conexion->ejecutaSQL($sql);
    }

    public function consultarConBD($sql)
    {
        return $this->conexion->consultarBD($sql);
    }

    public function empezarTransaccion()
    {
        $this->enTransaccion = true;
        $this->conexion->empezarTransaccion();
    }

    public function guardarCambios()
    {
        if (!$this->enTransaccion) {
            throw new Exception("No se ha iniciado ninguna transaccion");
        } else {
            $this->enTransaccion = false;
            $this->conexion->guardarCambios();
        }
    }

    public function descartarCambios()
    {
        if (!$this->enTransaccion) {
            throw new Exception("No se ha iniciado ninguna transaccion");
        } else {
            $this->enTransaccion = false;
            $this->conexion->descartarCambios();
        }
    }
}