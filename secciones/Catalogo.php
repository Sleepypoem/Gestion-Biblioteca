<?php
include("../Plantillas/Cabecera.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}
?>
<br>
<br>

<body>
    <div class="container">
        <div class="col-md-6">

            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Ingresa el ISBN del libro</label>
                    <input type="text" class="form-control" name="isbn" aria-describedby="book-isbn">
                    <small id="helpId" class="form-text text-muted">Buscalo en la contraportada o en la pagina de
                        copyright.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</body>

<?php
include("../Plantillas/Pie.php");
?>