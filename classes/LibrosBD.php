<?php
require_once "ConexionBD.php";
require_once "CopiasBD.php";
class LibrosBD extends ConexionBD
{

    function registrarLibro($libro, $codigoBibliotecario, $copias)
    {
        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario) VALUE 
        ('" . $libro->getISBN() . "','" . $libro->getTitulo() . "', '" . $libro->getAutor() . "', '" .
            $libro->getTipoDeLibro() . "', " . "'$codigoBibliotecario')";
        $this->enviarDatos($sql);
        $copiasBD = new CopiasBD();
        $copiasBD->generarCopias($libro->getISBN(), $copias);
    }

    public function obtenerLibros()
    {
        $sql = "SELECT * FROM v_libros";
        $listaLibros = $this->consultarDatos($sql);
        return $listaLibros;
    }
}