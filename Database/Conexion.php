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

    public function __construct($servidor, $nombreDB, $usuario, $contrasenia, $tabla)
    {
        $this->servidor = $servidor;
        $this->nombreDB = $nombreDB;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        $this->tabla = $tabla;
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
    public  function insertar(array $datos)
    {
        $this->validar($datos);

        $sql = "INSERT INTO $this->tabla (";

        /* ****** Este bloque for prepara el comando sql para insertar con el array que se le pasa ****** */

        for ($iterador = 0; $iterador < 2; $iterador++) {


            foreach ($datos as $llave => $dato) {
                if ($llave == array_key_last($datos)) {
                    $sql .= ($iterador == 0) ? $llave . ") VALUES (" : ":" . $llave . ")";
                } else {
                    $sql .= ($iterador == 0) ? $llave . ", " : ":" . $llave . ", ";
                }
            }
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
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
        foreach ($datos as $llave => $dato) {
            $sql .= $llave . " = " . $dato . ", ";
        }

        $sql = trim($sql, ", ");
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
    }

    /**
     * Busca un valor en la base de datos.
     *
     * @param [type] $id El id del valor a buscar.
     * @return array Un array asociativo con el resultado.
     */
    public function buscar($id)
    {
    }

    /**
     * Extrae todos los valores en la base de datos en un array.
     *
     * @return array Un array asociativo con los resultados.
     */
    public function leerTodos()
    {
    }

    private function agregarValores(PDOStatement $stmt, $datos)
    {
    }

    public function ejecutarQuery($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validar($valor)
    {
        if ($valor == null || $valor == "" || $valor == []) {
            throw new InvalidArgumentException("Este Valor no puede estar vacio!");
        }
    }
}
