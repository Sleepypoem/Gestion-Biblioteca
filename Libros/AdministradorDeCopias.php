<?php

require_once("Copia.php");

class AdministradorDeCopias
{
    public function crearCopias($libro, $cantidad)
    {
        for ($i = 0; $i < $cantidad; $i++) {
            $copias[] = new Copia($libro->getNombre() . "_copia_" . $i, "biblioteca");
        }
    }
}