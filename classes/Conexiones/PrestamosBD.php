<?php
date_default_timezone_set('America/Belize');
require_once "ConexionBD.php";
class PrestamosBD extends ConexionBD
{

    private $prestamo;
    private $codigoLector;
    private $codigoBibliotecario;
    private $isbn;

    public function prepararDatos($prestamo, $codigoLector, $codigoBibliotecario, $isbn)
    {
        $this->prestamo = $prestamo;
        $this->codigoLector = $codigoLector;
        $this->codigoBibliotecario = $codigoBibliotecario;
        $this->isbn = $isbn;
    }

    public function enviaraBD()
    {
        $sql = "INSERT INTO prestamo (fechaPrestamo, fechaDevolucion, codigoLector, codigoBbibliotecario, isbn, estado)
         VALUES (" . $this->prestamo->getInicio() . $this->prestamo->getFinal() . $this->codigoLector . ", " .
            $this->codigoBibliotecario . ", " . $this->isbn . ", 1)";

        $this->enviarDatos($sql);
    }

    public function editarEnBD($id, $datos)
    {
    }

    public function obtenerdeBD()
    {
        $sql = "SELECT * FROM prestamo";
        $listaPrestamos = $this->consultarDatos($sql);
        return $listaPrestamos;
    }
}