<?php

@require_once dirname(__DIR__, 2) . "\\config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\controllers\GestorDeLibros;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\AssertFalse;

class GestorDeLibrosTest extends TestCase
{

    private $intermediario;

    public function setUp(): void
    {
        $this->intermediario = $this->createMock(Intermediario::class);
    }

    public function testCrearLibroIncorrecto()
    {
        $datos = [
            "isbn" => null,
            "titulo" => "test",
            "idAutor" => "1",
            "tipoLibro" => "1",
            "codigoBbliotecario" => "",
            "image" => "",
            "estado" => "1",
            "copias" => "1"
        ];

        $this->intermediario->method("ejecutaSQL")->willReturn(false);
        $gestor = new GestorDeLibros($this->intermediario);
        assertFalse($gestor->crear($datos));
    }

    public function testCrearLibroCorrecto()
    {
        $datos = [
            "isbn" => "123456789",
            "titulo" => "test",
            "idAutor" => "1",
            "tipoLibro" => "1",
            "codigoBbliotecario" => "1000",
            "image" => "",
            "estado" => "1",
            "copias" => "1"
        ];

        $this->intermediario->method("ejecutaSQL")->willReturn(true);
        $gestor = new GestorDeLibros($this->intermediario);
        assertFalse($gestor->crear($datos));
    }
}