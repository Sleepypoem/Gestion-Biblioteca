<?php

namespace Alexander\Biblioteca\classes\controllers;

use Alexander\Biblioteca\classes\interfaces\IGestor as Gestor;

class Manejador
{
    private $request;
    private $gestor;
    private $id;
    private $data;

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
            header("HTTP/1.0 404 Not Found");
            echo "Resource not found in server";
        } else {
            echo json_encode(($lista));
            header("HTTP/1.0 200 OK");
        }
    }

    private function procesarPost(Gestor $gestor)
    {
        if ($this->data === null || $this->data === []) {
            header("HTTP/1.0 400 Bad Request");
            echo "Error in sent data";
            return;
        }

        $respuesta =  $gestor->crear($this->data);
        if ($respuesta === false) {
        } else {
            header("HTTP/1.0 201 Resource Created");
        }
    }

    private function procesarPut(Gestor $gestor)
    {
        //se obtiene el input y se guarda en una variable llamada $_PUT
        parse_str(file_get_contents('php://input'), $_PUT);

        if ($this->data === null || $this->data === []) {
            header("HTTP/1.0 400 Bad Request");
            echo "Error in sent data";
            return;
        }
        $respuesta = $gestor->actualizar($this->id, $_PUT);
        if ($respuesta === false) {
            header("HTTP/1.0 400 Bad Request");
            echo "Error in sent data";
        } else {
            header("HTTP/1.0 201 Resource Created");
        }
    }
}