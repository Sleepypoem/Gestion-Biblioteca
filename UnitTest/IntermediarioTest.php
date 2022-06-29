<?php

@require_once dirname(__DIR__) . "/config.php";

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertEmpty;

@require_once CONTROLLERS . "/GestorDeLibros.php";
@require_once VIEWS . "/CrearAlertas.php";
@require_once CONNECTIONS . "/ConexionBD.php";

class IntermediarioTest extends TestCase
{
    private static $conexion;
    private $intermediario;

    public static function setUpBeforeClass(): void
    {
        self::$conexion = ConexionBD::getInstance();
        self::$conexion->iniciarTransaccion();
    }

    public function testConsultarBD()
    {
        $intermediario = new Intermediario(self::$conexion);
        $sql = "SELECT * FROM libro";
        assertArrayHasKey(0, $intermediario->consultarConBD($sql));
    }

    public function testInsertarBD()
    {
        $intermediario = new Intermediario(self::$conexion);
        $sql = "INSERT INTO `tipos-de-libros`( `nombre`, `descripcion`)
         VALUES ('testCategoria','TestDescripcion')";
        assertTrue($intermediario->insertarEnBD($sql));
    }

    public function testEjecutarSQLSinRetorno()
    {
        $intermediario = new Intermediario(self::$conexion);
        $sql = "UPDATE `tipos-de-libros`SET `nombre` = 'test', `descripcion` = 'TestDesc'";
        assertEmpty($intermediario->ejecutarSQL($sql));
    }

    public function testEjecutarSQLConRetorno()
    {
        $intermediario = new Intermediario(self::$conexion);
        $sql = "UPDATE `tipos-de-libros`SET `nombre` = 'test', `descripcion` = 'TestDesc' WHERE idtipoLibro = 1";
        assertEmpty($intermediario->ejecutarSQL($sql));
    }

    public static function tearDownAfterClass(): void
    {
        self::$conexion->descartarCambios();
        self::$conexion = null;
    }
}