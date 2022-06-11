<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
include_once SITE_ROOT . "/classes/Conexiones/AutoresBD.php";
include_once SITE_ROOT . "/classes/Conexiones/CopiasBD.php";
include_once SITE_ROOT . "/classes/Conexiones/LibrosBD.php";
include_once SITE_ROOT . "/classes/Conexiones/PrestamosBD.php";
include_once SITE_ROOT . "/classes/Conexiones/TiposDeLibrosBD.php";
include_once SITE_ROOT . "/classes/Conexiones/UsuariosBD.php";
/* ************************************************************************************************************************************************ */

class Intermediario
{
    private $conexion;

    /**
     * Obtiene una lista de la base de datos.
     *
     * @param [string] $valor
     * @return array Una lista con los objetos sacados de la base de datos
     */
    public function obtenerDeBD($valor)
    {
        switch ($valor) {
            case 'libros':
                $this->conexion = new LibrosBD();
                $listaLibros = $this->conexion->obtenerDeBD();
                return $listaLibros;
                break;

            case 'copias':
                $this->conexion = new CopiasBD();
                $listaCopias = $this->conexion->obtenerDeBD();
                return $listaCopias;
                break;

            case 'autores':
                $this->conexion = new AutoresBD();
                $listaAutores = $this->conexion->obtenerDeBD();
                return $listaAutores;
                break;

            case 'tiposdelibros':
                $this->conexion = new TiposDeLibrosBD();
                $listaTiposDeLibros = $this->conexion->obtenerDeBD();
                return $listaTiposDeLibros;
                break;

            case 'prestamos':
                $this->conexion = new PrestamosBD();
                $listaPrestamos = $this->conexion->obtenerDeBD();
                return $listaPrestamos;
                break;

            case 'usuarios':
                $this->conexion = new UsuariosBD();
                $listaUsuarios = $this->conexion->obtenerDeBD();
                return $listaUsuarios;
                break;

            default:
                throw new Exception("No existen objetos de tipo '" . $valor . "' en la base de datos");

                break;
        }
    }


    /**
     * Inserta valores en su respectiva tabla en la base de datos.
     *
     * @param [string] $valor El tipo de objeto a insertar.
     * @param [type] $datos Un array asociativo con los datos opcionales para cada insercion.
     * @return void
     */
    public function insertarEnBD($valor, $datos)
    {
        switch ($valor) {
            case 'libros':
                $this->conexion = new LibrosBD();
                $this->conexion->prepararDatos($datos["libro"], $datos["codigoBibliotecario"], $datos["copias"]);
                $this->conexion->enviaraBD();
                break;

            case 'copias':
                $this->conexion = new CopiasBD();
                $this->conexion->prepararDatos($datos["copia"], $datos["cantidad"]);
                $this->conexion->enviaraBD();
                break;

            case 'autores':
                $this->conexion = new AutoresBD();
                $this->conexion->prepararDatos($datos["autor"]);
                $this->conexion->enviaraBD();
                break;

            case 'tiposdelibros':
                $this->conexion = new TiposDeLibrosBD();
                $this->conexion->prepararDatos($datos["tipoDeLibro"]);
                $this->conexion->enviaraBD();
                break;

            case 'prestamos':
                $this->conexion = new PrestamosBD();
                $this->conexion->prepararDatos($datos["prestamo"], $datos["codigoLector"], $datos["codigoBibliotecario"], $datos["isbn"]);
                $this->conexion->enviaraBD();
                break;

            case 'usuarios':
                $this->conexion = new UsuariosBD();
                $this->conexion->prepararDatos($datos["usuario"]);
                $this->conexion->enviaraBD();
                break;

            default:
                throw new Exception("No existen objetos de tipo '" . $valor . "' en la base de datos");

                break;
        }
    }
}