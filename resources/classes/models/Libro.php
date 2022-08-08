<?php

namespace Alexander\Biblioteca\classes\models;

require_once dirname(__DIR__, 3) . "/config.php";

use Alexander\Biblioteca\classes\controllers\Intermediario;
use Alexander\Biblioteca\classes\models\Model as Model;

use PDO;

class Libro extends Model
{
    private $isbn;
    private $titulo;
    private $idAutor;
    private $idTipoLibro;
    private $codigoBibliotecario;
    private $imagen = "sin definir";
    private $estado;
    private $copias;

    public function __construct(Intermediario $intermediario)
    {
        $this->intermediario = $intermediario;
    }

    public function guardar()
    {
        $sql = "INSERT INTO `libro`( `isbn`, `titulo`, `idAutor`, `tipoLibro`, `codigoBbliotecario`, `image`, `estado`,  `copias`) VALUES
         (:isbn, :titulo, :idAutor, :tipoLibro, :codigoBbliotecario, :image, :estado, :copias)";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function obtener(string | null $id): Model | bool
    {
        $sql = "SELECT * FROM `libro` WHERE `id` = :id";
        $valores = ["id" => $id];

        $stmt = $this->intermediario->ejecutaSQL($sql, $valores);
        $libro = $this->crearDesdeArray($stmt->fetch(PDO::FETCH_ASSOC));
        return $libro;
    }

    public function obtenerTodos()
    {
        $libros = [];
        $sql = "SELECT * FROM `libro`";

        $stmt = $this->intermediario->ejecutaSQL($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lista as $entrada) {
            $libros[] = $this->crearDesdeArray($entrada);
        }

        return $libros;
    }

    public function actualizar(string $id)
    {
        $sql = "UPDATE `libro` SET `isbn`= :isbn,`titulo`= :titulo,`idAutor`= :idAutor,`tipoLibro`= :tipoLibro,
        `codigoBbliotecario`= :codigoBbliotecario,`image`= :image,`estado`= :estado, `copias`= :copias WHERE `id`= :id";
        $valores = $this->datosComoArray();

        return $this->intermediario->ejecutaSQL($sql, $valores);
    }

    public function datosComoArray()
    {
        $datos = [];

        if (isset($this->id)) {
            $datos["id"] = $this->id;
        }

        $datos += [

            "isbn" => $this->isbn,
            "titulo" => $this->titulo,
            "idAutor" => $this->idAutor,
            "tipoLibro" => $this->idTipoLibro,
            "codigoBbliotecario" => $this->codigoBibliotecario,
            "image" => $this->imagen,
            "estado" => $this->estado,
            "copias" => $this->copias
        ];

        return $datos;
    }

    public function crearDesdeArray($array)
    {
        if (!$this->validar($array)) {
            return false;
        }

        $libro = new Libro($this->intermediario);
        $libro->setIsbn($array["isbn"])
            ->setTitulo($array["titulo"])
            ->setIdAutor($array["idAutor"])
            ->setIdTipoLibro($array["tipoLibro"])
            ->setCodigoBibliotecario($array["codigoBbliotecario"])
            ->setImagen($array["image"])
            ->setEstado($array["estado"])
            ->setcopias($array["copias"]);

        if (isset($array["id"])) {
            $libro->setId($array["id"]);
        }
        return $libro;
    }

    public function jsonSerialize(): mixed
    {

        return $this->datosComoArray();
    }
    /* *************************************************************** Getters y Setters ************************************************************** */

    /**
     * obtiene el valor de isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * define el valor de isbn
     *
     * @return  self
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of idAutor
     */
    public function getIdAutor()
    {
        return $this->idAutor;
    }

    /**
     * Set the value of idAutor
     *
     * @return  self
     */
    public function setIdAutor($idAutor)
    {
        $this->idAutor = $idAutor;

        return $this;
    }

    /**
     * Get the value of idTipoLibro
     */
    public function getIdTipoLibro()
    {
        return $this->idTipoLibro;
    }

    /**
     * Set the value of idTipoLibro
     *
     * @return  self
     */
    public function setIdTipoLibro($idTipoLibro)
    {
        $this->idTipoLibro = $idTipoLibro;

        return $this;
    }

    /**
     * Get the value of codigoBibliotecario
     */
    public function getCodigoBibliotecario()
    {
        return $this->codigoBibliotecario;
    }

    /**
     * Set the value of codigoBibliotecario
     *
     * @return  self
     */
    public function setCodigoBibliotecario($codigoBibliotecario)
    {
        $this->codigoBibliotecario = $codigoBibliotecario;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of copias
     */
    public function getCopias()
    {
        return $this->copias;
    }

    /**
     * Set the value of copias
     *
     * @return  self
     */
    public function setCopias($copias)
    {
        $this->copias = $copias;

        return $this;
    }
}