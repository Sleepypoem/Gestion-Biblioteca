<?php

/*
  Constantes para la base de datos y url necesarias
*/
defined("BD_HOST")
    or define("BD_HOST", "localhost");

defined("BD_USUARIO")
    or define("BD_USUARIO", "root");

defined("BD_NOMBRE")
    or define("BD_NOMBRE", "bd_biblioteca");

defined("BD_CONTRASENIA")
    or define("BD_CONTRASENIA", "");

$config = array(
    "urls" => array(
        "baseUrl" => "http://" . $_SERVER["HTTP_HOST"] . "/Gestion Biblioteca"
    ),
    "paths" => array(
        "resources" => "/resources",
        "images" => array(
            "content" => "http://" . $_SERVER["HTTP_HOST"] . "/Gestion Biblioteca/public_html/img/content",
            "layout" => "http://" . $_SERVER["HTTP_HOST"] . "/Gestion Biblioteca/public_html/img/layout"
        )
    )
);

/*
    Constantes para los require y los include.
*/

defined("ROOT")
    or define("ROOT", dirname(__DIR__) . "/Gestion Biblioteca");

defined("IMAGES")
    or define("IMAGES", ROOT . "/public_html/img/content/");

defined("LIBRARY")
    or define("LIBRARY", ROOT . '/resources/library');

defined("TEMPLATES")
    or define("TEMPLATES", ROOT . '/resources/templates');

defined("SECTIONS")
    or define("SECTIONS", ROOT . '/resources/sections');

defined("CONNECTIONS")
    or define("CONNECTIONS", ROOT . '/resources/classes/connections');

defined("INTERFACES")
    or define("INTERFACES", ROOT . '/resources/classes/interfaces');

defined("CONTROLLERS")
    or define("CONTROLLERS", ROOT . '/resources/classes/controllers');

defined("VIEWS")
    or define("VIEWS", ROOT . '/resources/classes/views');


/* **************************************************************** Error reporting *************************************************************** */
ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Belize');
/* ************************************************************************************************************************************************ */

/* ************************************************************** Funciones generales ************************************************************* */

/**
 * Mueve la imagen a la carpeta de imagenes.
 *
 * @param string $nombreTemporal El nombre temporal que se asigna al subirse por medio e $_POST.
 * @param string $ruta La carpeta donde se va a guardar.
 * @param string $nombreImagen El nombre final que tendra la imagen.
 * @return string El nombre con el que se guardo la imagen final.
 */
function  moverImagen($nombreTemporal, $ruta, $nombreImagen)
{
    $fechaDeHoy = new DateTime();
    $img = "img_" . $fechaDeHoy->getTimestamp() . "_" . $nombreImagen;
    move_uploaded_file($nombreTemporal, $ruta . "/" . $img);

    return $img;
}

function refrescarPagina($retraso, $archivoActual)
{
    echo "<meta http-equiv=\"Refresh\" content=\"$retraso;url=$archivoActual\">";
}

/* ************************************************************************************************************************************************ */