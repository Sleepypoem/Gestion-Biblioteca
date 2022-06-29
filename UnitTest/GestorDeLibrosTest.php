<?php

@require_once dirname(__DIR__) . "/config.php";

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

@require_once CONTROLLERS . "/GestorDeLibros.php";
@require_once VIEWS . "/CrearAlertas.php";

class GestorDeLibrosTest extends TestCase
{
    private static $conexion;
    private $alertas;
    private $intermediario;

    public static function setUpBeforeClass(): void
    {
        self::$conexion = ConexionBD::getInstance();
        self::$conexion->iniciarTransaccion();
    }

    public function setUp(): void
    {
        $this->alertas = new CrearAlertas();
        $this->intermediario = new Intermediario(self::$conexion);
    }

    public function testRegistroLibroIsbnNulo()
    {
        $texto = "¡El isbn no puede estar vacio!";

        $gestor = new GestorDeLibros(null, "testTitulo", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testRegistroLibroIsbnVacio()
    {
        $texto = "¡El isbn no puede estar vacio!";

        $gestor = new GestorDeLibros("", "testTitulo", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testRegistroLibroTituloVacio()
    {
        $texto = "¡El titulo no puede estar vacio!";

        $gestor = new GestorDeLibros("000000", "", 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testRegistroLibroTituloNulo()
    {
        $texto = "¡El titulo no puede estar vacio!";

        $gestor = new GestorDeLibros("000000", null, 10, 1, 1);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testLibroSinCopias()
    {
        $texto = "¡Tiene que tener minimo una copia!";

        $gestor = new GestorDeLibros("000000", "testTitulo", 1, 1, 0);
        assertEquals($this->alertas->crearAlertaFallo($texto), $gestor->registrarLibro());
    }

    public function testInsertarLibro()
    {
        $texto = "Libro agregado con exito";

        $gestor = new GestorDeLibros("000000", "testTitulo", 1, 1, 1);
        assertEquals($this->alertas->crearAlertaExito($texto), $gestor->registrarLibro());
    }

    public function testEditarLibro()
    {
        $texto = "Libro editado con exito";

        $gestor = new GestorDeLibros("000000", "testTitulo", 1, 1, 1);
        assertEquals($this->alertas->crearAlertaExito($texto), $gestor->editarLibro(1));
    }

    public static function tearDownAfterClass(): void
    {
        self::$conexion->descartarCambios();
        self::$conexion = null;
    }
}