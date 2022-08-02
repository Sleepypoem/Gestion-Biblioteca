<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
  Constantes para la base de datos y url necesarias
*/

$config = array(
    "urls" => array(
        "baseUrl" => "http://" . $_SERVER["HTTP_HOST"] . "/{$_ENV["ROOT"]}"
    ),
    "paths" => array(
        "resources" => "/resources",
        "assets" => "http://" . $_SERVER["HTTP_HOST"] . "/public_html/",
        "images" => array(
            "content" => "http://" . $_SERVER["HTTP_HOST"] . "/{$_ENV["ROOT"]}/public_html/img/content",
            "layout" => "http://" . $_SERVER["HTTP_HOST"] . "/{$_ENV["ROOT"]}/public_html/img/layout"
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

/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set($_ENV["ZONA_HORARIA"]);