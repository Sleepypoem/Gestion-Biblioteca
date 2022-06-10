<?php

class Libro
{
    private $isbn;
    private $titulo;
    private $autor;
    private $tipoLibro;

    function __construct($isbn, $titulo, $autor, $tipoLibro)
    {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->tipoLibro = $tipoLibro;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function setISBN($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setTipoDeLibro($tipoLibro)
    {
        $this->tipoLibro = $tipoLibro;
    }

    public function getTipoDeLibro()
    {
        return $this->tipoLibro;
    }
}