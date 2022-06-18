<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once $_SERVER['DOCUMENT_ROOT'] . "/Organizacion-prueba/config.php";
include_once TEMPLATES . "/Cabecera.php";
require_once VIEWS . "/CrearComponentes.php";
/* ************************************************************************************************************************************************ */
function obtenerNombrePagina()
{
    return "Pruebas";
}

$creador = new CrearComponentes();
$listaPrueba = ["id-prueba", "valor-prueba"]
?>

<body>
    <div class="p-5 bg-light">
        <div class="container">
            <h1 class="display-3">Jumbo heading</h1>
            <p class="lead">Jumbo helper text</p>
            <hr class="my-2">
            <p>More info</p>
            <p class="lead">
                <button class="btn btn-info" onclick="bootstrapAlert()"><i class="bi-alarm"
                        style="font-size: 2rem; color: red;"></i></button>

                <span class="visually-hidden">Button</span>
                </button>
        </div>
    </div>


    <div class="mb-3">
        <label class="form-label">Texto de prueba</label>
        <?php $creador->crearFormElemento("text", "bi bi-person-circle", "prueba-texto"); ?>
        <small id="helpId" class="form-text text-muted">
            este es un form de prueba
        </small>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Ingresa el autor del libro
        </label>

        <div class="input-group">
            <span class="input-group-text" id="select-test">
                <i class="bi bi-person-lines-fill"></i>
            </span>

            <select name="autor" class="form-control">
                <option value="1">test</option>
                <option value="2">test2</option>
                <option value="3">test3</option>
            </select>
        </div>
    </div>

    <div class="container text-center">
        <div class="alert alert-info w-20 fade show">
            <i class="bi bi-info-circle"></i>Hola, soy una alerta
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Heading</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustomUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="validationCustomUsername"
                        aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom03" class="form-label">City</label>
                <input type="text" class="form-control" id="validationCustom03" required>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustom04" class="form-label">State</label>
                <select class="form-select" id="validationCustom04" required>
                    <option selected disabled value="">Choose...</option>
                    <option>...</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid state.
                </div>
            </div>
            <div class="col-md-3">
                <label for="validationCustom05" class="form-label">Zip</label>
                <input type="text" class="form-control" id="validationCustom05" required>
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>

    <script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    function bootstrapAlert() {
        $("bootstrap-growl").remove();
        $.bootstrapGrowl("alerta correcta", {
            type: "info",
            offset: {
                from: "top",
                amount: 20
            },
            width: 150,
            align: "center",
            delay: 4000,
            allow_dismiss: true,
            stackup_spacing: 100

        });
    }
    </script>
    </p>
    </div>
    </div>
</body>

<footer class="card-footer text-muted">
</footer>

</html>

<script>
function bootstrapAlert() {
    $("bootstrap-growl").remove();
    $.bootstrapGrowl("alerta correcta", {
        type: "info",
        offset: {
            from: "top",
            amount: 20
        },
        width: 150,
        align: "center",
        delay: 30000,
        allow_dismiss: false,
        stackup_spacing: 100

    });
}
</script>
</p>
</div>
</div>
</body>

<?php
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */
$d = [
    "-",
    "-",
    "-"
];
echo sprintf("[1%s2121%s2121%s1]\n",  $d);
?>