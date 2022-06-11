<?php

interface IFabrica
{
    /**
     * Crea objetos mostrables.
     *
     * @param [string] $tipo El tipo de objeto que se desea.
     * @param [mixed] $datos Los datos del objeto a crear, en forma de array asociativo.
     * @return IMostrable Un objeto mostrable.
     */
    public function crear(string $tipo, array $datos): IMostrable;
}