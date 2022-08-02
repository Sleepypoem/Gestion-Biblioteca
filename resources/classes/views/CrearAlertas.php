<?php

namespace Alexander\Biblioteca\classes\views;
/* ***************************************************************** Dependencias ***************************************************************** */

include_once $_SERVER['DOCUMENT_ROOT'] . "/Gestion Biblioteca/config.php";
/* ************************************************************************************************************************************************ */

class CrearAlertas
{

    public function crearAlertaExito($mensaje)
    {
        return $this->crearAlerta("success", $mensaje, "check-circle-fill");
    }

    public function crearAlertaFallo($mensaje)
    {
        return $this->crearAlerta("danger", $mensaje, "x-circle-fill");
    }

    public function crearAlertaAdvertencia($mensaje)
    {
        return $this->crearAlerta("warning", $mensaje, "exclamation-triangle-fill");
    }

    public function crearAlertaInfo($mensaje)
    {
        return $this->crearAlerta("info", $mensaje, "question-circle-fill");
    }

    private function crearAlerta($tipo, $mensaje, $icono)
    {
        $alerta = <<<_ALERTA
            <div class="container text-center">
            <div class="alert alert-$tipo d-inline-flex " role="alert"><i
            class="bi bi-$icono flex-grow-1" style="font-size: 1rem;"></i>
            <div class=" flex-grow-2">&nbsp$mensaje&nbsp</div>&nbsp<button type="button"
            class="btn-close align-self-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            _ALERTA;

        return $alerta;
    }
}