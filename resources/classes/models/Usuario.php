<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Usuario extends Model
{
    private $codigo;
    private $nombre;
    private $telefono;
    private $direccion;
    private $usuario;
    private $password;
    private $imagen;
    private $estado;


    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `usuario`(`nombre`, `telefono`, `direccion`, `usuario`, `password`, `imagen`, `estado`) VALUES 
        ( :nombre , :telefono , :direccion , :usuario , :password , :imagen , :estado )";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {
        if ($id === null) {
            return false;
        }

        $sql = "SELECT * FROM `usuario` WHERE `codigo` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $usuario = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $usuario;
    }

    public function obtenerTodos()
    {
        $usuarios = [];
        $sql = "SELECT * FROM `usuario`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            print_r($entrada);
            $usuarios[] = $this->crearDesdeArray($entrada);
        }

        return $usuarios;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `usuario` SET `nombre`= :nombre ,`telefono`= :telefono ,`direccion`= :direccion ,`usuario`= :usuario ,
        `password`= :password ,`imagen`= :imagen ,`estado`= :estado  WHERE `codigo` = :codigo";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["codigo"] = $this->id;
        }

        $datos += [

            "nombre" => $this->nombre,
            "telefono" => $this->telefono,
            "direccion" => $this->direccion,
            "usuario" => $this->usuario,
            "password" => $this->password,
            "imagen" => $this->imagen,
            "estado" => $this->estado
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $usuario = new Usuario($this->intermediario);
        $usuario->setNombre($array["nombre"])
            ->setTelefono($array["telefono"])
            ->setDireccion($array["direccion"])
            ->setUsuario($array["usuario"])
            ->setPassword($array["password"])
            ->setImagen($array["imagen"])
            ->setEstado($array["estado"]);

        if (isset($array["codigo"])) {
            $usuario->setId($array["codigo"]);
        }
        return $usuario;
    }

    public function jsonSerialize(): mixed
    {
        return $this->datosComoArray();
    }
    /* *************************************************************** Getters y Setters ************************************************************** */



    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}