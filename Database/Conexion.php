<?php
require("ConexionInterfaz.php");
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

    /**
     * Inyectamos el objeto libro para trabajar en esta clase.
     *
     * @param [type] $libro El objeto libro con el que se va a trabajar.
     * @return void
     */
    public function setLibro($libro)
    {
        $this->libro = $libro;
    }

    /**
     * Obtiene el objeto libro actual.
     *
     * @return Libro
     */
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

    /**
     * Inserta un objeto en la base de datos.
     *
     * @return void
     */
    public function insertar()
    {
        $sql = "INSERT INTO $this->tabla ( ID, isbn, titulo, autor, tipo_libro, codigo_bibliotecario, estado ) 
                VALUES (null, :isbn, :titulo, :autor, :tipo_libro, :codigo_bibliotecario, :estado)";
        $this->prepareInsert($sql);
    }

    /**
     * Edita un objeto en la base de datos.
     *
     * @param [type] $id
     * @param [array] $datos 
     * @return void
     */
    public function actualizar($id, array $datos)
    {
        $this->validar($id);
        $this->validar($datos);

        $sql = "UPDATE $this->table SET ";
        foreach ($datos as $key => $value) {
            $sql .= $key . " = " . $value . ", ";
        }

        $sql = trim($sql, ",");
        $sql  .= "WHERE id = $id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    /**
     * Elimina una valor de la base de datos.
     *
     * @param [type] $id EL id del objeto a borrar.
     * @return void
     */
    public function borrar($id)
    {
        $this->validar($id);
        print_r($id);
        $sql = "DELETE FROM $this->tabla WHERE ID = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    /**
     * Busca un valor en la base de datos.
     *
     * @param [type] $id El id del valor a buscar.
     * @return array Un array asociativo con el resultado.
     */
    public function buscar($id)
    {
        $this->validar($id);
        $sql = "SELECT * FROM $this->tabla WHERE ID = $id";
        echo $sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Extrae todos los valores en la base de datos en un array.
     *
     * @return array Un array asociativo con los resultados.
     */
    public function leerTodos()
    {
        $sql = "SELECT * FROM $this->tabla";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function prepareInsert($sql)
    {
        //Desde aqui habria que modificar pero sera cuando tenga los campos de la base de datos y del objeto que se va a usar.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":isbn", $this->libro->getIsbn());
        $stmt->bindValue(":titulo", $this->libro->getTitulo());
        $stmt->bindValue(":autor", $this->libro->getAutor());
        $stmt->bindValue(":tipo_libro", $this->libro->getTipoLibro());
        $stmt->bindValue(":codigo_bibliotecario", $this->libro->getCodigoBibliotecario());
        $stmt->bindValue(":estado", $this->libro->getEstado());

        $stmt->execute();
    }

    private function validar($valor)
    {
        if ($valor == null || $valor == "" || $valor == []) {
            throw new InvalidArgumentException("Este Valor no puede estar vacio!");
        }
    }
}