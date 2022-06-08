<?php
class Libros implements IEnviarDatos, IConsultarDatos, IEjecutarSQL
{
    use Basededatos;
    function enviarDatos($array)
    {
        $sql = "INSERT INTO libro (isbn, titulo, idAutor, tipoLibro, codigoBbliotecario) VALUE('$array[0]', '$array[1]', '$array[2]', '$array[3]', '$array[4]')";
        $query = $this->pdo()->prepare($sql);
        @$insertarLibro = $query->execute();
        if ($insertarLibro) {
            $this->generarCopias($array[0], $array[5]);
        }
        return ($insertarLibro) ? $this->mensaje('Registrado') : $this->mensaje('Error');
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