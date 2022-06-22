<?php

/*
  Constantes para la base de datos y url necesarias
*/

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
defined("IMAGES")
    or define("IMAGES", __DIR__ . "/public_html/img/content");

defined("ROOT")
    or define("ROOT", __DIR__);

defined("LIBRARY")
    or define("LIBRARY", __DIR__ . '/resources/library');

defined("TEMPLATES")
    or define("TEMPLATES", __DIR__ . '/resources/templates');

defined("SECTIONS")
    or define("SECTIONS", __DIR__ . '/resources/sections');

defined("CONNECTIONS")
    or define("CONNECTIONS", __DIR__ . '/resources/classes/connections');

defined("INTERFACES")
    or define("INTERFACES", __DIR__ . '/resources/classes/interfaces');

defined("CONTROLLERS")
    or define("CONTROLLERS", __DIR__ . '/resources/classes/controllers');

defined("VIEWS")
    or define("VIEWS", __DIR__ . '/resources/classes/views');


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
/* ************************************************************************************************************************************************ */