<?php

/* ***************************************************************** Dependencias ***************************************************************** */
require_once "./classes/Fabricas/Fabrica.php";
require_once "Intermediario.php";
/* ************************************************************************************************************************************************ */

class GestorDeCache
{
    private $libros = [];
    private $copias = [];
    private $autores = [];
    private $tiposDeLibros = [];
    private $prestamos = [];
    private $intermediario;
    private $fabrica;

    function __construct()
    {
    }

    function generarCache($valor)
    {
        switch ($valor) {
            case 'libros':
                $this->intermediario = new Intermediario();
                $listaCompleta = $this->intermediario->obtenerDeBD($valor);
                foreach ($listaCompleta as $elemento) {
                    $this->libros[] = $elemento;
                }
                break;

            default:
                # code...
                break;
        }
    }
}