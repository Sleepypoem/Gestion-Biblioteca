<?php

/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
require_once INTERFACES . "/IValidar.php";
require_once VIEWS . "/CrearAlertas.php";
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
    private $alertas;

    function __construct($isbn, $titulo, $idAutor, $idTipoLibro, $copias)
    {
        $this->alertas = new CrearAlertas();
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
        if (!$this->validarCampo($this->titulo)) {
            return $this->alertas->crearAlertaFallo("El titulo no puede estar vacio!");
        }

        if (!$this->validarCampo($this->isbn)) {
            return $this->alertas->crearAlertaFallo("El isbn no puede estar vacio!");
        }

        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario, image, estado) 
        VALUES ('$this->isbn', '$this->titulo', $this->idAutor, $this->idTipoLibro, $this->codigoBibliotecario, '$this->imagen', 1)";

        $this->comunicarseConBD($sql);

        $sql = "CALL insertarCopias('$this->isbn', $this->copias);";

        $this->comunicarseConBD($sql);

        return $this->alertas->crearAlertaExito("Libro agregado con exito");
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