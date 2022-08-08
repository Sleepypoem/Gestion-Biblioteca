<?php


namespace Alexander\Biblioteca\UnitTest;

require_once dirname(__DIR__, 2) . "/config.php";

use PHPUnit\Framework\TestCase;

use Alexander\Biblioteca\classes\controllers\Intermediario;
use PDO;
use PDOStatement;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;
use PHPUnit\Framework\MockObject\MockClass;

class IntermediarioTest extends TestCase
{

    private $pdo;

    public function setUp(): void
    {
        $this->conexion =
            $this->createMock(PDO::class);
    }

    protected function getMockedPDO()
    {
        $query = $this->createMock(PDOStatement::class);
        $query->method('execute')->willReturn(true);

        $db = $this->createMock(PDO::class);

        $db->method('prepare')->willReturn($query);

        return $db;
    }

    public function testEjecutarSQLSinRetorno()
    {
        $db = $this->getMockedPDO();
        $intermediario = new Intermediario();
        $intermediario->setPdo($db);
        $sql = "UPDATE `tipos-de-libros`SET `nombre` = 'test', `descripcion` = 'TestDesc'";
        $result = $intermediario->ejecutaSQL($sql);
        assertTrue($result);
    }

    public function testEjecutarSQLConRetorno()
    {
        $this->conexion->method("ejecutaSQL")
            ->willReturn(array(0 => ["codigoLector" => 1001]));
        $intermediario = new Intermediario();
        $sql = "SELECT * FROM lector WHERE codigoLector = 1001";
        assertNotEmpty($intermediario->ejecutarSQL($sql));
    }
}