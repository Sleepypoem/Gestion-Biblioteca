<?php

class Conexion implements ConexionInterfaz
{
    private $pdo;
    private $servidor;
    private $nombreDB;
    private $usuario;
    private $contrasenia;
    private $tabla;
    private $libro;

    public function __construct($servidor, $nombreDB, $usuario, $contrasenia, $tabla)
    {
        $this->servidor = $servidor;
        $this->nombreDB = $nombreDB;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        $this->tabla = $tabla;
    }

    public function setLibro($libro)
    {
        $this->libro = $libro;
    }

    public function getLibro()
    {
        return $this->libro;
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

    public function insertar()
    {
        $sql = "INSERT INTO $this->tabla ( ID, name, image, description) VALUES (null, :name, :image, :description)";
        $this->process($sql, $this->libro);
    }

    public function actualizar($id)
    {
        $sql = "INSERT INTO $this->table ( id, name, img, description) VALUES ($id, ?, ?, ?)";
        $this->process($sql, $this->libro);
    }

    public function borrar($id)
    {
        print_r($id);
        $sql = "DELETE FROM $this->tabla WHERE ID = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function buscar($id)
    {

        $sql = "SELECT * FROM $this->tabla WHERE ID = $id";
        echo $sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerTodos()
    {
        $sql = "SELECT * FROM $this->tabla";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function process($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":name", $project->get("name"));
        $stmt->bindValue(":image", $project->get("img"));
        $stmt->bindValue(":description", $project->get("description"));

        $stmt->execute();
    }
}