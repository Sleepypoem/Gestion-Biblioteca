<?php

namespace Alexander\Biblioteca\classes\controllers;
/* ***************************************************************** Dependencias ***************************************************************** */

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario as Intermediario;
use Alexander\Biblioteca\classes\interfaces\IGestor as IGestor;
use Alexander\Biblioteca\classes\interfaces\IValidar as IValidar;
use Alexander\Biblioteca\classes\views\CrearAlertas as CrearAlertas;

use Exception;
/* ************************************************************************************************************************************************ */

class GestorDeAutores implements IGestor, IValidar
{
    private $intermediario;
    private $nombre;
    private $fechaDeNacimiento;
    private $imagen;
    private $alertas;

    function __construct($nombre, $fechaDeNacimiento, $intermediario = null)
    {
        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }

        $this->nombre = $nombre;
        $this->fechaDeNacimiento = $fechaDeNacimiento;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Se encarga de todo lo necesario para agregar el autor a la base de datos con los datos pasados en el constructor.
     *
     * @return string Un mensaje de confirmacion o de error.
     */
    public function agregarAutor()
    {
        if (!$this->validarCampo($this->nombre)) {
            return $this->alertas->crearAlertaFallo("El nombre no puede estar vacio!");
        }

        $sql = "INSERT INTO `autor`( `nombre`, `fechaNacimiento`, `image`) 
        VALUES ('$this->nombre', '$this->fechaDeNacimiento', '$this->imagen')";

        if (!$this->comunicarseConBD("ejecutar", $sql)) {
            return $this->alertas->crearAlertaFallo("Error agregando el autor.");
        }
        return $this->alertas->crearAlertaExito("Autor agregado con exito");
    }

    /**
     * Se encarga de todo lo necesario para editar el autor en la base de datos
     * con los datos pasados al constructor y un id para identificar la tabla a editar.
     *
     * @param int $id El id de la fila a editar.
     * @return void
     */
    public function editarAutor($id)
    {
        $sql = "UPDATE `autor` SET `nombre`='$this->nombre',`fechaNacimiento`='$this->fechaDeNacimiento',`image`='$this->imagen' WHERE `idAutor` = $id";

        if (!$this->comunicarseConBD("ejecutar", $sql)) {
            return $this->alertas->crearAlertaFallo("Error editando el autor.");
        }
        return $this->alertas->crearAlertaExito("Autor editado con exito");
    }


    function validarCampo($entrada): bool
    {
        if ($entrada == "" || $entrada == null) {
            return false;
        }

        return true;
    }


    function comunicarseConBD($tipo, $sql)
    {
        if ($tipo === "ejecutar") {
            return $this->intermediario->insertarEnBD($sql);
        } else if ($tipo === "consultar") {
            return $this->intermediario->consultarConBD($sql);
        } else {
            throw new Exception("Error de tipo");
        }
    }
}