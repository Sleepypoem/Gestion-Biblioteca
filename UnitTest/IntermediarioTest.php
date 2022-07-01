<?php

@require_once dirname(__DIR__) . "/config.php";

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;

@require_once CONTROLLERS . "/GestorDeLibros.php";
@require_once VIEWS . "/CrearAlertas.php";
@require_once CONNECTIONS . "/ConexionBD.php";

class IntermediarioTest extends TestCase
{
    private $conexion;
    private $intermediario;

    public function setUp(): void
    {
        $this->conexion = $this->createMock(ConexionBD::class);
    }

    public function testConsultarBD()
    {
        $this->conexion->method("consultarBD")
            ->willReturn(array(0));
        $intermediario = new Intermediario($this->conexion);
        $sql = "SELECT * FROM libro";
        assertArrayHasKey(0, $intermediario->consultarConBD($sql));
    }

    public function testInsertarBD()
    {
        $this->conexion->method("agregarBD")
            ->willReturn(true);
        $intermediario = new Intermediario($this->conexion);
        $sql = "INSERT INTO `tipos-de-libros`( `nombre`, `descripcion`)
         VALUES ('testCategoria','TestDescripcion')";
        assertTrue($intermediario->insertarEnBD($sql));
    }

    public function testEjecutarSQLSinRetorno()
    {
        $this->conexion->method("ejecutaSQL")
            ->willReturn(array());
        $intermediario = new Intermediario($this->conexion);
        $sql = "UPDATE `tipos-de-libros`SET `nombre` = 'test', `descripcion` = 'TestDesc'";
        assertEmpty($intermediario->ejecutarSQL($sql));
    }

    public function testEjecutarSQLConRetorno()
    {
        $this->conexion->method("ejecutaSQL")
            ->willReturn(array(0 => ["codigoLector" => 1001]));
        $intermediario = new Intermediario($this->conexion);
        $sql = "SELECT * FROM lector WHERE codigoLector = 1001";
        assertNotEmpty($intermediario->ejecutarSQL($sql));
    }
}