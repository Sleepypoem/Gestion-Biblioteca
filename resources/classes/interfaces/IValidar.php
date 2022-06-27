<?php

interface IValidar
{
    /**
     * Valida que el campo ingresado no este vacio.
     *
     * @param string $entrada El texto a evaluar.
     * @return bool true si el campo no esta vacio, false en caso contrario.
     */
    function validarCampo($entrada): bool;
}