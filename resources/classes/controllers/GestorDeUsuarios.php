<?php

/* ***************************************************************** Dependencias ***************************************************************** */
require_once CONTROLLERS . "/Intermediario.php";
require_once INTERFACES . "/IGestor.php";
require_once INTERFACES . "/IValidar.php";
require_once VIEWS . "/CrearAlertas.php";
/* ************************************************************************************************************************************************ */

class GestorDeUsuarios implements IGestor, IValidar
{
    private $intermediario;
    private $alertas;
    private $nombre;
    private $usuario;
    private $telefono  = "Sin definir";
    private $direccion  = "Sin definir";
    private $contrasenia;
    private $imagen  = "Sin definir";
    private $rol;

    public function __construct($nombre, $usuario, $contrasenia, $rol, $intermediario = null)
    {

        $this->alertas = new CrearAlertas();

        //si pasan el intermediario por el constructor usamos ese, sino creamos uno
        if ($intermediario === null) {
            $this->intermediario = new Intermediario();
        } else {
            $this->intermediario = $intermediario;
        }

        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Se encarga de todo lo relacionado con los usuarios en la base de datos con los datos
     * pasados al constructor y devuelve un mensaje dependiendo del resultado.
     *
     * @return void
     */
    public function registrarUsuario()
    {
        if (!$this->validarCampo($this->nombre)) {
            return $this->alertas->crearAlertaFallo("El nombre no puede estar vacío");
        }

        if (!$this->validarCampo($this->usuario)) {
            return $this->alertas->crearAlertaFallo("El nombre de usuario no puede estar vacío");
        }

        if (!$this->comprobarUsuario()) {
            return $this->alertas->crearAlertaFallo("El nombre de usuario ya esta en uso");
        }

        if (!$this->validarCampo($this->contrasenia)) {
            return $this->alertas->crearAlertaFallo("Ingresa una contraseña");
        }

        if (!$this->validarContrasenia()) {
            return $this->alertas->crearAlertaFallo("La contraseña debe tener minimo 8 letras o numeros, una mayuscula y una minuscula.");
        }

        //despues de comprobar la contraseña hacemos un hash y enviamos a la base de datos
        $contraseniaSegura = password_hash($this->contrasenia, PASSWORD_BCRYPT);

        //estado 2 para los bibliotecarios, 1 para los usuarios y 3 para el administrador
        $estado = ($this->rol == "usuario") ? 1 : 2;

        $sql = "INSERT INTO `usuario`(`nombre`, `telefono`, `direccion`, `usuario`, `password`, `imagen`, `estado`) 
        VALUES ('$this->nombre','$this->telefono','$this->direccion','$this->usuario','$contraseniaSegura','$this->imagen','$estado')";

        if (!$this->comunicarseConBD("ejecutar", $sql)) {
            return $this->alertas->crearAlertaFallo("Error registrando al usuario.");
        }

        //obtenemos el codigo del usuario que acabamos de insertar para añadirlo a la tabla lector o bibliotecario dependiendo de su rol
        $sql = "SELECT codigo FROM usuario WHERE usuario = '$this->usuario'";
        $codigo = $this->comunicarseConBD("consultar", $sql)[0]["codigo"];

        if ($this->rol === "bibliotecario") {

            $sql = "INSERT INTO `bibliotecario`(`codigoBbliotecario`, `rol`) VALUES ('$codigo','$this->rol')";
            $this->comunicarseConBD("ejecutar", $sql);
        } else if ($this->rol === "usuario") {

            $sql = "INSERT INTO `lector`(`codigoLector`) VALUES ($codigo)";
            if (!$this->comunicarseConBD("ejecutar", $sql)) {
                return $this->alertas->crearAlertaFallo("Error registrando al usuario como lector.");
            };
        }

        return $this->alertas->crearAlertaExito("Usuario añadido con exito");
    }

    /**
     * Se encarga de todo lo necesario para editar el usuario en la base de datos
     * con los datos pasados al constructor y un id para identificar la fila a editar.
     *
     * @param int $id El id de la fila a editar.
     * @return string un mensaje de error o de fallo.
     */
    public function editarUsuario($id)
    {
        if (!$this->validarCampo($this->nombre)) {
            return $this->alertas->crearAlertaFallo("El nombre no puede estar vacío");
        }

        if (!$this->validarCampo($this->usuario)) {
            return $this->alertas->crearAlertaFallo("El nombre de usuario no puede estar vacío");
        }

        if (!$this->validarCampo($this->contrasenia)) {
            return $this->alertas->crearAlertaFallo("Ingresa una contraseña");
        }

        if (!$this->validarContrasenia()) {
            return $this->alertas->crearAlertaFallo("La contraseña debe tener minimo 8 letras o numeros, una mayuscula y una minuscula.");
        }

        //despues de comprobar la contraseña hacemos un hash y enviamos a la base de datos
        $contraseniaSegura = password_hash($this->contrasenia, PASSWORD_BCRYPT);

        $sql = "UPDATE `usuario` SET `nombre`='$this->nombre',`telefono`='$this->telefono',
        `direccion`='$this->direccion',`usuario`='$this->usuario',`password`='$contraseniaSegura',
        `imagen`='$this->imagen' WHERE codigo = $id";

        if (!$this->comunicarseConBD("ejecutar", $sql)) {
            return $this->alertas->crearAlertaFallo("Error editando al usuario.");
        }

        return $this->alertas->crearAlertaExito("Usuario editado con exito");
    }

    /**
     * Verifica que el nombre de usuario no este repetido.
     *
     * @return bool true si el nombre de usuario esta disponible, false de lo contrario.
     */
    private function comprobarUsuario()
    {
        $sql = "SELECT codigo FROM `usuario` WHERE usuario = '$this->usuario'";
        $usuario = $this->comunicarseConBD("consultar", $sql);

        if ($usuario != []) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Valida que la contraseña coincida con la expresion regular
     *
     * @return bool true si la contraceña coincide, false de lo contrario
     */
    private function validarContrasenia()
    {
        //la contraseña debe tener al menos una mayuscula, una minuscula, un numero y minimo 8 caracteres.
        $expresion = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";

        if (preg_match($expresion, $this->contrasenia) === 1) {
            return true;
        }

        return false;
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