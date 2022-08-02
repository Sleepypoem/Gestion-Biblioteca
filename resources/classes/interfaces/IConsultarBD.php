<?php

namespace Alexander\Biblioteca\classes\interfaces;

interface IConsultarBD
{
    public function consultarBD($sql): array;
}