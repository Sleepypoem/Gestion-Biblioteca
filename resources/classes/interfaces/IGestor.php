<?php

namespace Alexander\Biblioteca\classes\interfaces;

interface IGestor
{
    /**
     * Se encarga de la logica de crear una entrada en la base de datos, los pasos adicionales y validaciones necesarias.
     *
     * @param array $data los datos con los que se creara la entrada.
     * @return bool true en caso de exito, false si no.
     */
    public function crear(array $data);

    /**
     * Se encarga de la logica de obtener una entrada de la base de datos y de arreglar los valores para hacerlos mas claros.
     *
     * @param integer|null $id el id de una entrada que se quiera obtener, si no se pasa se obtienmen todas las entradas.
     * @return array|bool|Model un array con los objetos Model si no se paso el id y tuvo exito, un objeto Model unico si se paso el id y false en caso de error.
     */
    public function leer($id = null);

    /**
     * Se encarga de la logica de actualizar una entrada en la base de datos.
     *
     * @param integer $id el id de la entrada a actualizar.
     * @param array $data un array con los datos con los que se busca reemplazar el objeto.
     * @return bool true en caso de exito, false si no.
     */
    public function actualizar(int $id, array $data);
}