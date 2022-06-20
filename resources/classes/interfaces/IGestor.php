<?php

interface IGestor
{
    /** 
     * Se comunica con la base de datos para enviar o consultar datos.
     * 
     * @param string $sql La instruccion sql a ejecutar.
     * @return array Un array con los resultados, de haberlos.
     */
    function comunicarseConBD($sql): array;
}