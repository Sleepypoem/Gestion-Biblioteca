<?php
require_once "ConexionBD.php";
require_once "CopiasBD.php";
class LibrosBD extends ConexionBD
{
    private $libro;
    private $codigoBibliotecario;
    private $copias;

    public function prepararDatos(Libro $libro, $codigoBibliotecario, $copias)
    {
        $this->libro = $libro;
        $this->codigoBibliotecario = $codigoBibliotecario;
        $this->copias = $copias;
    }

    function enviaraBD()
    {
        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario) VALUE 
        ('" . $this->libro->getISBN() . "','" . $this->libro->getTitulo() . "', '" . $this->libro->getAutor() . "', '" .
            $this->libro->getTipoDeLibro() . "', " . "'$this->codigoBibliotecario')";
        $this->enviarDatos($sql);
        $copiasBD = new CopiasBD();
        $copiasBD->enviaraBD($this->libro->getISBN(), $this->copias);
    }

    public function editarEnBD($id, $datos)
    {
    }

    public function obtenerDeBD()
    {
        $sql = "SELECT * FROM v_libros";
        $listaLibros = $this->consultarDatos($sql);
        return $listaLibros;
    }
}