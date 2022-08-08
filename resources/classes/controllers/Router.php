<?php

namespace Alexander\Biblioteca\classes\controllers;

class Router
{
    private static $rutas;

    /**
     * Agrega las rutas a la lista.
     *
     * @param string $dir la ruta url.
     * @param callable $funcion una funcion que se ejecutara para esa url especifica.
     * @return void
     */
    public static function agregarRutas(string $dir, callable $funcion)
    {
        self::$rutas[$dir] = $funcion;
    }

    /**
     * Se encarga de procesar las redirecciones y ejecutar las funciones asignadas
     *
     * @param String $uri la ruta que se quiere procesar, si no se encuentra redirige a /404
     * @return void
     */
    public static function procesar(String $uri)
    {
        $encontrado = false;

        foreach (self::$rutas as $dir => $funcion) {
            if ($dir !== $uri) {
                continue;
            }
            $encontrado = true;
            $funcion();
        }

        if (!$encontrado) {
            $funcion404 = self::$rutas["/404"];
            $funcion404();
        }
    }
}