<?php

include("../Plantillas/Cabecera.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}
?>

<body>
    <br>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header card-header text-white text-center bg-dark">
                Prestar libro
            </div>
            <div class="card-body">

                <form action="Prestamos.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Ingresa el ISBN del libro</label>
                        <input type="text" class="form-control" name="prestamos-isbn" aria-describedby="book-isbn"
                            required>
                        <small id="helpId" class="form-text text-muted">Buscalo en la contraportada o en la
                            página de copyright.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ingresa el codigo del lector</label>
                        <input type="text" class="form-control" name="codigo-lector" aria-describedby="codigo-lector"
                            required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Hacer prestamo</button>
                </form>

            </div>
            <div class="card-footer bg-dark text-muted">

            </div>
        </div>
    </div>
</body>


<?php
include("../Plantillas/Pie.php");
?>