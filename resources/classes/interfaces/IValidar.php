<?php

namespace Alexander\Biblioteca\classes\interfaces;

interface IValidar
{
    /**
     * Valida que el array ingresado no contenga valores nulos o vacios.
     *
     * @param array $entrada El array a evaluar.
     * @return bool true si el array no tiene valores nulos o vacios, false en caso contrario.
     */
    function validar($entrada);
}