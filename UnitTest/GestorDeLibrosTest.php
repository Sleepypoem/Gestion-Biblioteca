<?php

require_once dirname(__DIR__) . "/config.php";

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

require_once CONTROLLERS . "/GestorDeLibros.php";
require_once VIEWS . "/CrearAlertas.php";

class GestorDeLibrosTest extends TestCase
{

    private $alertas;

    public function setUp(): void
    {
        $this->alertas = new CrearAlertas();
    }

    public function testLibroIsbnNulo()
    {
        $texto = "¡El isbn no puede estar vacio!";

        $gestor = new GestorDeLibros(null, "testTitulo", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testLibroIsbnVacio()
    {
        $texto = "¡El isbn no puede estar vacio!";

        $gestor = new GestorDeLibros("", "testTitulo", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testLibroTituloVacio()
    {
        $texto = "¡El titulo no puede estar vacio!";

        $gestor = new GestorDeLibros("000000", "", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testLibroTituloNulo()
    {
        $texto = "¡El titulo no puede estar vacio!";

        $gestor = new GestorDeLibros(null, "", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }
}