<?php

namespace Alexander\Biblioteca\classes\controllers;

class GestorDeCache
{
    private $ruta;

    public function __construct()
    {
        $this->ruta = dirname(__DIR__, 2) . "\\cache\\";
    }

    public function crearCache($nombre, $datos)
    {
        $cache = fopen($this->ruta . $nombre . "-cache.json", "w");
        fwrite($cache, json_encode($datos));
        fclose($cache);

        return $nombre . "-cache.json";
    }

    public function leerCache($nombre)
    {
        if (file_exists($this->ruta . $nombre)) {
            $result = json_decode(file_get_contents($this->ruta . $nombre), true);
        } else {
            return false;
        }

        return $result;
    }
}
