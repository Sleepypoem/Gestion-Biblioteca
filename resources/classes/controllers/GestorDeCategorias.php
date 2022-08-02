<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__, 3) . "/config.php";
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

    function __construct($nombre, $descripcion, $intermediario = null)
    {
        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }
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

    /**
     * Se encarga de todo lo necesario para editar la categoria en la base de datos
     * con los datos pasados al constructor y un id para identificar la fila a editar.
     *
     * @param int $id El id de la fila a editar.
     * @return void
     */
    public function editarCategoria($id)
    {
        $sql = "UPDATE `tipos-de-libros` SET nombre = '$this->nombre', descripcion = '$this->descripcion' WHERE idtipoLibro = $id";

        try {
            $this->comunicarseConBD($sql);
        } catch (PDOException $e) {
            return $this->alertas->crearAlertaFallo("Error al comunicarse con la base de datos. Error: " . $e);
        }

        return $this->alertas->crearAlertaExito("Categoria editada con exito");
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