<?php
require_once "../autocargaLIBROS.php";
class LibrosBD implements IEnviarDatos, IConsultarDatos, IEjecutarSQL
{
    use Basededatos;


    function registrarLibro($libro, $codigoBibliotecario, $copias)
    {
        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario) VALUE 
        ('$libro->getISBN()', '$libro->getTitulo()', '$libro->getAutor()', '$libro->getTipoDeLibro', '$codigoBibliotecario')";
        $this->enviarDatos($sql);
        $this->generarCopias($libro->getISBN(), $copias);
    }

    public function obtenerLibros()
    {
        $sql = "SELECT * FROM v_libros";
        $listaLibros = $this->consultarDatos($sql);
        return $listaLibros;
    }

    function enviarDatos($sql)
    {
        $stmt = $this->pdo()->prepare($sql);
        $queryResult = $stmt->execute();
        return ($queryResult) ? $this->mensaje('Registrado') : $this->mensaje('Error');
    }

    function consultarDatos($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    function ejecutaSQL($sql)
    {
        $query = $this->pdo()->prepare($sql);
        $query->execute();
    }
    function mensaje($msj)
    {
        return ('<script>$msj</script>');
    }
    function generarCopias($isbn, $cantidad)
    {
        $sql = "CALL insertarCopias('$isbn', $cantidad);";
        $copias = new Copias();
        $copias->enviarDatos($sql);
    }
}