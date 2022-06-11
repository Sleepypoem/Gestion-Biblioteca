<?php

interface IMostrable
{
    /**
     * Obtiene los datos de esta clase en forma de array asociativo.
     *
     * @return array Un array asociativo con los atributos de esta clase.
     */
    public function datosComoArray(): array;
}