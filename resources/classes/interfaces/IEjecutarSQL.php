<?php

namespace Alexander\Biblioteca\classes\interfaces;

use PDOStatement;

interface IEjecutarSQL
{
    /**
     * Prepara una sentencia sql con placeholders y los vincula con el array proporcionado,
     *  luego lo ejecuta y devuelve el resultado
     *
     * @param string $sql la sentencia sql con los placeholders
     * @param array $datos Los datos con los que vincular los placeholders.
     * @return PDOStatement El PDOStatement resultante despues de la query.
     */
    function ejecutaSQL(string $sql, array $datos = []);
}