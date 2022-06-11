<?php

/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
require_once SITE_ROOT . "/classes/Fabricas/Fabrica.php";
require_once SITE_ROOT . "/Libros/Libro.php";
require_once SITE_ROOT . "/Libros/Copia.php";
require_once SITE_ROOT . "/Libros/Autor.php";
require_once SITE_ROOT . "/Libros/TipoDeLibro.php";
require_once SITE_ROOT . "/Usuarios/Prestamo.php";
require_once SITE_ROOT . "/classes/Intermediario/Intermediario.php";
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
        $this->intermediario = new Intermediario();
        $this->fabrica = new Fabrica();
    }

    function generarCache($valor)
    {
        switch ($valor) {
            case 'libros':
                $listaCompleta = $this->intermediario->obtenerDeBD($valor);
                foreach ($listaCompleta as $elemento) {
                    $datos = array(
                        "isbn" => $elemento->isbn,
                        "titulo" => $elemento->titulo,
                        "autor" => $elemento->Autor,
                        "tipoLibro" => $elemento->{'Tipo de Libro'},
                        "imagen" => $elemento->image

                    );

                    $this->libros[] = $this->fabrica->crear("libro", $datos);
                }
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Get the value of libros
     */
    public function getLibros()
    {
        return $this->libros;
    }
}

$cache = new GestorDeCache();
$cache->generarCache("libros");
print_r($cache->getLibros());