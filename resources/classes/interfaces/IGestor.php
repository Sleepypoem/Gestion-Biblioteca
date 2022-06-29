<?php

interface IGestor
{
    /** 
     * Se comunica con la base de datos para enviar o consultar datos.
     * 
     * @param string $sql La instruccion sql a ejecutar.
     * @return array|bool Un array con los resultados, de haberlos, false si la ejecucion de SQL fallo.
     */
    function comunicarseConBD($tipo, $sql);
}