<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__FILE__) . "\\config.php";

use Alexander\Biblioteca\classes\controllers\Router as Router;
use Alexander\Biblioteca\classes\controllers\GestorDeLibros;
use Alexander\Biblioteca\classes\controllers\GestorDeAutores as GestorDeAutores;
use Alexander\Biblioteca\classes\controllers\GestorDeCategorias as GestorDeCategorias;
use Alexander\Biblioteca\classes\controllers\GestorDeDevoluciones as GestorDeDevoluciones;
use Alexander\Biblioteca\classes\controllers\GestorDePrestamos as GestorDePrestamos;
use Alexander\Biblioteca\classes\controllers\GestorDeUsuarios as GestorDeUsuarios;
use Alexander\Biblioteca\classes\controllers\Manejador as Manejador;
/* ************************************************************************************************************************************************ */

/* ********************************************************************* Rutas ******************************************************************** */

//Solucion provisional: asi se eliminan los numeros de la uri, los numeros los obtenemos despues
$uri = preg_replace("/[^a-zA-Z\/\-_]/", "", $_SERVER["REQUEST_URI"]);

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "libros/", function () {
    //creamos un gestor del tipo correctp y pasamos al manejador los datos que hagan falta
    $gestor = new GestorDeLibros();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }

    $manejador->setData($_POST);
    $manejador->procesar();
});

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "usuarios/", function () {
    $gestor = new GestorDeUsuarios();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }

    $manejador->setData($_POST);
    $manejador->procesar();
});

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "prestamos/", function () {
    $gestor = new GestorDePrestamos();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }

    $manejador->setData($_POST);
    $manejador->procesar();
});

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "devoluciones/", function () {
    $gestor = new GestorDeDevoluciones();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }

    $manejador->setData($_POST);
    $manejador->procesar();
});

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "autores/", function () {
    $gestor = new GestorDeAutores();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }
    $manejador->setData($_POST);

    $manejador->procesar();
});

Router::agregarRutas("/{$_ENV["ROOT"]}/" . "tipos/", function () {
    $gestor = new GestorDeCategorias();
    $id = preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    $manejador = new Manejador($_SERVER["REQUEST_METHOD"], $gestor);

    if ($id != null) {
        $manejador->setId($id);
    }

    $manejador->setData($_POST);
    $manejador->procesar();
});

Router::agregarRutas("/404", function () {
    echo preg_replace("/[^0-9]/", "", $_SERVER["REQUEST_URI"]);
    header("HTTP/1.0 404 Not Found");
});

Router::procesar($uri);

/* ************************************************************************************************************************************************ */