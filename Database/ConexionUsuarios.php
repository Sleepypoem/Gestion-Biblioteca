<?php

require_once("Conexion.php");

class ConexionUsuarios extends Conexion
{

    private $tabla;
    private $usuario;

    public function __construct($servidor, $nombreDB, $usuario, $contrasenia, $tabla)
    {

        parent::__construct($servidor, $nombreDB, $usuario, $contrasenia);
        $this->tabla = $tabla;
    }


    /**
     * Inserta un objeto en la base de datos.
     *
     * @return void
     */
    public function insertar()
    {
        $sql = "INSERT INTO $this->tabla ( codigo, nombre, telefono, direccion, usuario, contrasenia, estado ) 
                VALUES (:codigo, :nombre, :telefono, :direccion, :usuario, :contrasenia, :estado)";
        $this->prepararInsercion($sql);
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

        $sql = trim($sql, ", ");
        $sql  .= "WHERE codigo = $id";

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
        $sql = "DELETE FROM $this->tabla WHERE codigo = $id";
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
        $sql = "SELECT * FROM $this->tabla WHERE codigo = $id";
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

    private function prepararInsercion($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":codigo", $this->usuario->getCodigo());
        $stmt->bindValue(":nombre", $this->usuario->getNombre());
        $stmt->bindValue(":telefono", $this->usuario->getTelefono());
        $stmt->bindValue(":direccion", $this->usuario->getDireccion());
        $stmt->bindValue(":usuario", $this->usuario->getUsuario());
        $stmt->bindValue(":contrasenia", $this->usuario->getContrasenia());
        $stmt->bindValue(":estado", $this->usuario->getEstado());

        $stmt->execute();
    }

    private function validar($valor)
    {
        if ($valor == null || $valor == "" || $valor == []) {
            throw new InvalidArgumentException("Este Valor no puede estar vacio!");
        }
    }
}