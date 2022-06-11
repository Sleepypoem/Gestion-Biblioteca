<?php

class Fabrica implements IFabrica
{
    public function crear($tipo, $datos): IMostrable
    {
        switch ($tipo) {
            case 'libro':
                return new Libro($datos["isbn"], $datos["titulo"], $datos["autor"], $datos["tipoLibro"], $datos["imagen"]);
                break;

            case 'copia':
                return new Copia($datos["isbn"]);
                break;

            case 'autor':
                return new Autor($datos["nombre"], $datos["fechaDeNacimiento"]);
                break;

            case 'tipodelibro':
                return new TipoDeLibro($datos["nombre"], $datos["descripcion"]);
                break;

            case 'multa':
                return new Multa($datos["fechaDevolucion"], $datos["tarifa"]);
                break;

            case 'prestamo':
                return new Prestamo($datos["inicio"], $datos["final"]);
                break;

            case 'usuario':
                return new Usuario(
                    $datos["nombre"],
                    $datos["codigo"],
                    $datos["email"],
                    $datos["direccion"],
                    $datos["contrasenia"],
                    $datos["telefono"],
                    $datos["imagen"]
                );
                break;

            default:
                throw new Exception("Tipo invalido, no existe objeto '" . $tipo . "'");

                break;
        }
    }
}