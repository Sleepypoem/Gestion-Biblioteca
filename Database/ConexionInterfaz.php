<?php

interface ConexionInterfaz
{
    public function conectar();
    public function insertar();
    public function actualizar($id, array $data);
    public function borrar($id);
    public function buscar($id);
    public function leerTodos();
}