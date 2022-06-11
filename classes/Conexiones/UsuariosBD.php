<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once "ConexionBD.php";
/* ************************************************************************************************************************************************ */
class UsuariosBD extends ConexionBD
{
    private $usuario;

    public function prepararDatos($usuario)
    {
        $this->usuario = $usuario;
    }

    public function enviaraBD()
    {
        $sql = "INSERT INTO usuario (codigo, nombre, telefono, direccion, usuario, password, imagen, estado)
         VALUES (" . $this->usuario->getCodigo() . $this->usuario->getNombre() . $this->usuario->getTelefono() . ", " .
            $this->usuario->getDireccion() . ", " . $this->usuario->getEmail() . ", " . $this->usuario->getContrasenia() .
            ", " . $this->usuario->getImagen() . " 1)";

        $this->enviarDatos($sql);
    }

    public function editarEnBD($id, $datos)
    {
    }

    public function obtenerdeBD()
    {
        $sql = "SELECT * FROM usuario";
        $listausuarios = $this->consultarDatos($sql);
        return $listausuarios;
    }
}