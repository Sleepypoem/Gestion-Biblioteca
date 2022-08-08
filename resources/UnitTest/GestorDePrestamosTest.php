<?php

@require_once dirname(__DIR__) . "/config.php";

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

@require_once CONTROLLERS . "/GestorDePrestamos.php";
@require_once CONTROLLERS . "/Intermediario.php";
@require_once VIEWS . "/CrearAlertas.php";

class GestorDePrestamosTest extends TestCase
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

    public function testRealizarPrestamo()
    {
        $texto = "Se registro el prestamo";

        $gestor = new GestorDePrestamos(1001, 1000, "0-2021-2022-1");
        assertEquals($this->alertas->crearAlertaExito($texto), $gestor->prestar());
    }

    public static function tearDownAfterClass(): void
    {
        self::$conexion->descartarCambios();
        self::$conexion = null;
    }
}