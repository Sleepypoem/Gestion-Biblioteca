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

    function __construct($isbn, $titulo, $idAutor, $idTipoLibro, $copias, $intermediario = null)
    {
        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }
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
            return $this->alertas->crearAlertaFallo("¡El titulo no puede estar vacio!");
        }

        if (!$this->validarCampo($this->isbn)) {
            return $this->alertas->crearAlertaFallo("¡El isbn no puede estar vacio!");
        }

        if ($this->copias <= 0) {
            return $this->alertas->crearAlertaFallo("¡Tiene que tener minimo una copia!");
        }

        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario, image, estado) 
        VALUES ('$this->isbn', '$this->titulo', $this->idAutor, $this->idTipoLibro, $this->codigoBibliotecario, '$this->imagen', 1)";

        try {
            $this->comunicarseConBD($sql);
        } catch (PDOException $e) {
            return $this->alertas->crearAlertaFallo("Erro comunicandose con la base de datos. Error: " . $e);
        }


        $sql = "CALL insertarCopias('$this->isbn', $this->copias);";

        $this->comunicarseConBD($sql);

        return $this->alertas->crearAlertaExito("Libro agregado con exito");
    }

    /**
     * Se encarga de todo lo necesario para editar el libro en la base de datos
     * con los datos pasados al constructor y un id para identificar la fila a editar.
     *
     * @param int $id El id de la fila a editar.
     * @return string un mensaje de error o de fallo.
     */
    public function editarLibro($id)
    {
        if (!$this->validarCampo($this->titulo)) {
            return $this->alertas->crearAlertaFallo("¡El titulo no puede estar vacio!");
        }

        if (!$this->validarCampo($this->isbn)) {
            return $this->alertas->crearAlertaFallo("¡El isbn no puede estar vacio!");
        }

        $sql = "UPDATE `libro` SET `isbn`='$this->isbn',`titulo`='$this->titulo',`idAutor`='$this->idAutor',`tipoLibro`='$this->idTipoLibro',
        `codigoBbliotecario`='$this->codigoBibliotecario',`image`='$this->imagen' WHERE id= $id";

        try {
            $this->comunicarseConBD($sql);
        } catch (PDOException $e) {
            return $this->alertas->crearAlertaFallo("Erro comunicandose con la base de datos. Error: " . $e);
        }

        return $this->alertas->crearAlertaExito("Libro editado con exito");
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