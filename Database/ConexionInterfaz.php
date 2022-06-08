<?php

interface ConexionInterfaz
{
    public function conectar();
    public function insertar(array $data);
    public function actualizar($id, array $data);
    public function borrar($id);
    public function buscar($id);
    public function leerTodos();
}