<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
require_once INTERFACES . "/IValidar.php";
require_once VIEWS . "/CrearAlertas.php";
/* ************************************************************************************************************************************************ */

class GestorDeCategorias implements IGestor, IValidar
{
    private $intermediario;
    private $nombre;
    private $descripcion = "sin descripcion";
    private $alertas;

    function __construct($nombre, $descripcion)
    {
        $this->alertas = new CrearAlertas();
        $this->intermediario = new Intermediario();
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    /**
     * Se encarga de todo lo necesario para agregar una categoria a la base de datos con los datos pasados al constructor.
     *
     * @return string Un mensaje de confirmacion o de error.
     */
    public function agregarCategoria()
    {
        if (!$this->validarCampo($this->nombre)) {
            return $this->alertas->crearAlertaFallo("El nombre no puede estar vacio!");
        } else {
            $sql = "INSERT INTO `tipos-de-libros` (nombre, descripcion) VALUES ('$this->nombre', '$this->descripcion')";
            $this->comunicarseConBD($sql);

            return $this->alertas->crearAlertaExito("Categoria agregada con exito");
        }
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