<?php
date_default_timezone_set('America/Belize');
require_once "ConexionBD.php";
class PrestamosBD extends ConexionBD
{

    public function hacerPrestamo($datos)
    {
        $fechadeHoy = $this->fechaDeHoy();
        $fechaUnaSemana = $fechadeHoy->modify("+1 week");

        $sql = "INSERT INTO prestamo (fechaPrestamo, fechaDevolucion, codigoLector, codigoBbibliotecario, isbn, estado)
         VALUES (" . $fechadeHoy->format("Y-m-d") . $fechaUnaSemana->format("Y-m-d") . $datos["codigoLector"] . ", " .
            $datos["codigoBbibliotecario"] . ", " . $datos["isbn"] . ", 1)";

        $this->enviarDatos($sql);
    }

    public function consultarPrestamos()
    {
        $sql = "SELECT * FROM prestamo";
        $listaPrestamos = $this->consultarDatos($sql);
        return $listaPrestamos;
    }

    private function fechaDeHoy()
    {
        return new DateTime();
    }
}