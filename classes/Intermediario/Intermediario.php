<?php

include_once "./classes/Conexiones/AutoresBD.php";
include_once "./classes/Conexiones/CopiasBD.php";
include_once "./classes/Conexiones/LibrosBD.php";
include_once "./classes/Conexiones/PrestamosBD.php";
include_once "./classes/Conexiones/TiposDeLibros.php";
include_once "./classes/Conexiones/VistasLibros.php";

class Intermediario
{
    private $libros = [];
    private $copias = [];
    private $autores = [];
    private $prestamos = [];
    private $tiposDeLibros = [];

    function __construct()
    {
    }
}