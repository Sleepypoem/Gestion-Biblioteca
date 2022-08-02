<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__, 3) . "/config.php";
/* ************************************************************************************************************************************************ */

class CrearComponentes
{
    public function crearTarjeta($valor, $fuenteImg, $nombre)
    {
        echo "<div class=\"card index-element index-flex-child\">" .
            "<div class=\"card-header text-center bg-light\">" .
            "<i class=\"$fuenteImg\" style=\"font-size: 2rem; color: black;\"></i>" .


            " </div>" .
            "<div class=\"card-body card-body-font text-center\">" .
            $valor .
            "</div>" .
            "<div class=\"card-footer text-white text-center bg-dark\">" .
            $nombre .
            "</div>" .
            "</div>";
    }

    public function crearFormElemento($tipo, $fuenteImg, $nombre, $adicionales = "")
    {
        echo "<div class=\"input-group \">" .
            "<span class=\"input-group-text\" id=\"$nombre-adicion\">" .
            "<i class=\"$fuenteImg\"></i>" .
            " </span>" .
            " <input type=\"$tipo\" class=\"form-control\" name=\"$nombre\" aria-describedby=\"form-texto-de-$nombre\" $adicionales>" .
            "</div>";
    }
}