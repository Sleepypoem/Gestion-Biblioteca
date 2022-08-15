<?php

namespace Alexander\Biblioteca\classes\controllers;

use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;

class Manejador
{
    private $request;
    private $gestor;
    private $id;
    private $data;

    public const RESP_404 = "Resource not found";
    public const RESP_400 = "Error in sent data";
    public const RESP_201 = "Resource Created";
    public const RESP_200 = "OK";

    public function __construct(string $request, Gestor $gestor)
    {
        $this->request = $request;
        $this->gestor = $gestor;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function procesar()
    {
        switch ($this->request) {
            case 'GET':
                return $this->procesarGet($this->gestor);
                break;

            case 'POST':
                return $this->procesarPost($this->gestor);
                break;

            case 'PUT':
                return $this->procesarPut($this->gestor);
                break;

            default:
                header("HTTP/1.0 405 Method not Allowed");
                echo "ALLOW:GET,POST,PUT";
                break;
        }
    }

    private function procesarGet(Gestor $gestor)
    {
        $lista = $gestor->leer($this->id);
        if ($lista === false) {
            $this->respuesta_json(404, self::RESP_404, null);

            return;
        }


        $this->respuesta_json(200, self::RESP_200, $lista);
    }

    private function procesarPost(Gestor $gestor)
    {
        if ($this->data === null || $this->data === []) {
            $this->respuesta_json(400, self::RESP_400, null);
            return;
        }

        $respuesta =  $gestor->crear($this->data);
        if ($respuesta === false) {
            $this->respuesta_json(400, self::RESP_400, null);
        } else {
            $this->respuesta_json(201, self::RESP_201, null);
        }
    }

    private function procesarPut(Gestor $gestor)
    {
        //se obtiene el input y se guarda en una variable llamada $_PUT
        parse_str(file_get_contents('php://input'), $_PUT);

        if ($this->data === null || $this->data === []) {
            $this->respuesta_json(400, self::RESP_400, null);
            return;
        }

        $respuesta = $gestor->actualizar($this->id, $_PUT);

        if ($respuesta === false) {
            $this->respuesta_json(404, self::RESP_404, null);
        } else {
            $this->respuesta_json(201, self::RESP_201, null);
        }
    }

    public function procesarImagen()
    {
        $handler = new ManejadordeImagenes();
        if ($this->id === null) {
            $lista = $handler->leer();
            $this->respuesta_json(200, self::RESP_200, $lista);
            return;
        }
        $this->redirect($handler->leer($this->id));
    }

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }



    function respuesta_json($estatus, $mensaje, $data, $tipo = "application/json")
    {
        header("HTTP/1.1 $estatus $mensaje");
        header("Content-Type: $tipo; charset=UTF-8");
        $respuesta['statusCode'] = $estatus;
        $respuesta['statusMessage'] = $mensaje;
        $respuesta['data'] = $data;

        echo json_encode($respuesta, JSON_PRETTY_PRINT);
    }
}