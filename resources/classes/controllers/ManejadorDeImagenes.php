<?php

namespace Alexander\Biblioteca\classes\controllers;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\interfaces\IGestor;

class ManejadordeImagenes implements IGestor
{
    private $ruta;

    public function __construct($ruta = null)
    {
        $this->ruta = dirname(__FILE__, 3) . "\\img\\";

        if ($ruta !== null) {
            $this->ruta .= "$ruta\\";
        }
    }

    public function crear(array $data)
    {
        $validar = $this->validar($data['imagen']);

        if ($validar === true) {
            $imagen = $this->guardarImagen($data['imagen']);

            if ($imagen !== false) {
                return $imagen;
            } else {
                return false;
            }
        } else {
            return "default.png";
        }

        return false;
    }

    private function guardarImagen($base64_image_string)
    {
        //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=guardarImagen($base64_image_string, $img_con_extension, getcwd() . "/application/assets/pins/$user_id/"); }      
        //
        //data is like:    data:image/png;base64,asdfasdfasdf
        $nombre = uniqid("IMG_");
        $array = explode(',', substr($base64_image_string, 5), 2);
        $mime = $array[0];
        $data = $array[1];

        $mime_sin_base_64 = explode(';', $mime, 2);
        $mime_split = explode('/', $mime_sin_base_64[0], 2);
        if (count($mime_split) == 2) {
            $extension = $mime_split[1];
            if ($extension == 'jpeg') {
                $extension = 'jpg';
            }

            $nombre .= '.' . $extension;
        }

        if (file_exists($this->ruta . $nombre)) {
            return false;
        } else {
            file_put_contents($this->ruta . $nombre, base64_decode($data));
            return $nombre;
        }
    }

    public function leer($id = null)
    {
        $listado = [];

        if ($id !== null) {
            return "http://{$_ENV["BD_HOST"]}/{$_ENV["ROOT"]}/resources/img/$id";
        } else {
            $directorio = opendir($this->ruta); //ruta actual

            $contador = 0;

            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
            {
                if (!is_dir($archivo)) //verificamos si es o no un directorio
                {
                    $listado[$contador] = $archivo;
                    stripslashes($listado[$contador]);
                }
                $contador++;
            }
        }

        $listado = array_values($listado);



        if (count($listado) != 0) {
            return $listado;
        } else {
            return false;
        }
    }

    public function actualizar(int $id, array $data)
    {
        throw new \Exception("Method not implemented");
    }

    private function validar($string)
    {
        $array = explode(",", $string);
        if (($array[0] == "data:image/jpeg;base64") || ($array[0] == "data:image/gif;base64") || ($array[0] == "data:image/png;base64")) {
            return true;
        } else {
            return false;
        }
    }
}

$g = new ManejadordeImagenes();