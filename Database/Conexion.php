<?php

require("ConexionInterfaz.php");

abstract class Conexion implements ConexionInterfaz
{
    protected $pdo;
    protected $servidor;
    protected $nombreDB;
    protected $usuario;
    protected $contrasenia;

    public function __construct($servidor, $nombreDB, $usuario, $contrasenia)
    {
        $this->servidor = $servidor;
        $this->nombreDB = $nombreDB;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
    }

    /**
     * Establece la conexion con la base de datos.
     *
     * @return void
     */
    public function conectar()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->servidor;dbname=$this->nombreDB", "$this->usuario", "$this->contrasenia");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error conectando a la base de datos " . $e;
        }
    }
    

    /**
     * Inserta un objeto en la base de datos.
     *
     * @return void
     */
    public abstract function insertar();

    /**
     * Edita un objeto en la base de datos.
     *
     * @param [type] $id
     * @param [array] $datos 
     * @return void
     */
    abstract public function actualizar($id, array $datos);

    /**
     * Elimina una valor de la base de datos.
     *
     * @param [type] $id EL id del objeto a borrar.
     * @return void
     */
    abstract public function borrar($id);

    /**
     * Busca un valor en la base de datos.
     *
     * @param [type] $id El id del valor a buscar.
     * @return array Un array asociativo con el resultado.
     */
    abstract public function buscar($id);

    /**
     * Extrae todos los valores en la base de datos en un array.
     *
     * @return array Un array asociativo con los resultados.
     */
    abstract public function leerTodos();
}