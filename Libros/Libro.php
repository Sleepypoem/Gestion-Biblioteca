<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once "./interfaz/IMostrable.php";
/* ************************************************************************************************************************************************ */

class Libro implements IMostrable
{
    private $isbn;
    private $titulo;
    private $autor;
    private $tipoLibro;
    private $imagen;

    function __construct($isbn, $titulo, $autor, $tipoLibro, $imagen)
    {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->tipoLibro = $tipoLibro;
        $this->imagen = $imagen;
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

    public function datosComoArray(): array
    {
        $retorno = array(
            "isbn" => $this->isbn,
            "titulo" => $this->titulo,
            "autor" => $this->autor,
            "tipoLibro" => $this->tipoLibro,
            "imagen" => $this->imagen

        );

        return $retorno;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}