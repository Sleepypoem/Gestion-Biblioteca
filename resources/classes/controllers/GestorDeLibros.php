<?php

/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
require_once INTERFACES . "/IValidar.php";
/* ************************************************************************************************************************************************ */

class GestorDeLibros implements IGestor, IValidar
{
    private $intermediario;
    private $isbn;
    private $titulo;
    private $idAutor;
    private $idTipoLibro;
    private $codigoBibliotecario = 1000;
    private $imagen = "sin definir";
    private $copias;

    function __construct($isbn, $titulo, $idAutor, $idTipoLibro, $copias)
    {
        $this->intermediario = new Intermediario();
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->idAutor = $idAutor;
        $this->idTipoLibro = $idTipoLibro;
        $this->copias = $copias;
    }

    public function setCodigoBibliotecario($codigoBibliotecario)
    {
        $this->codigoBibliotecario = $codigoBibliotecario;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function registrarLibro()
    {
        $this->procesarIsbn();

        if (!$this->validarCampo($this->titulo)) {
            return "El titulo no puede estar vacio";
        }

        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario, image, estado) 
        VALUES ('$this->isbn', '$this->titulo', $this->idAutor, $this->idTipoLibro, $this->codigoBibliotecario, '$this->imagen', 1)";

        $this->comunicarseConBD($sql);

        $sql = "CALL insertarCopias('$this->isbn', $this->copias);";

        $this->comunicarseConBD($sql);

        return "Libro ingresado con exito";
    }

    private function procesarIsbn()
    {
        if ($this->validarCampo($this->isbn)) {
            $this->formatearIsbn();
        } else {
            throw new Exception("El isbn no puede estar vacio");
        }
    }

    private function formatearIsbn()
    {
        $arrayIsbn = str_split($this->isbn);

        for ($iterador = 0; $iterador < count($arrayIsbn); $iterador++) {
            $resultado[] = $arrayIsbn[$iterador];
            if ($iterador == 0 || $iterador == 4 || $iterador == 8) {
                $resultado[] = "-";
            }
        }

        $this->isbn = implode($resultado);
    }

    function validarCampo(string $entrada): bool
    {
        if ($entrada == "" || $entrada == null) {
            return false;
        }

        return true;
    }

    function comunicarseConBD($sql): array
    {
        return $this->intermediario->ejecutarSQL($sql);
    }
}