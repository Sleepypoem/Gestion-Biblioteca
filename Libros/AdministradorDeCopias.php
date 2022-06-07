<?php

require_once("Copia.php");

class AdministradorDeCopias
{
    public function crearCopias($libro, $cantidad)
    {
        $copias = [];
        for ($i = 0; $i < $cantidad; $i++) {
            $copias[] = new Copia($libro->getNombre() . "_copia_" . $i, "biblioteca");
        }

        return $copias;
    }
}