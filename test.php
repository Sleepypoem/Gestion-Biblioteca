<?php
/* ***************************************************************** Dependencias ***************************************************************** */
require_once dirname(__DIR__) . "/Gestion-Biblioteca" . "/config.php";
include_once TEMPLATES . "/Cabecera.php";
require_once CONTROLLERS . "/Intermediario.php";
require_once CONNECTIONS . "/ConexionBD.php";
/* ************************************************************************************************************************************************ */
function obtenerNombrePagina()
{
    return "Pruebas";
}

function crearAlerta($tipo, $mensaje)
{
    $icono = "exclamation-triangle-fill";
    $estilo = "success";

    switch ($tipo) {
        case 'exito':
            $icono = "check-circle-fill";
            $estilo = "success";
            break;

        case 'fallo':
            $icono = "x-circle-fill";
            $estilo = "danger";
            break;

        case 'advertencia':
            $icono = "exclamation-triangle-fill";
            $estilo = "warning";
            break;

        case 'info':
            $icono = "question-circle-fill";
            $estilo = "info";
            break;
    }
    echo "<div class=\"container text-center\">" .
        "<div class=\"alert alert-$estilo d-inline-flex \" role=\"alert\">" .
        "<i class=\"bi bi-$icono flex-grow-1\" style=\"font-size: 1rem;\"></i>" .
        "<div class=\" flex-grow-2\">" .
        "&nbsp" . $mensaje .
        "</div>" . "&nbsp" .
        "<button type=\"button\" class=\"btn-close align-self-end\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>" .
        "</div></div>";
}


if ($_POST) {
    $nombre = $_POST["text"];

    echo crearAlerta("info", $nombre);
}
?>



<body>
    <form action="" method="post">
        <div class="mb-3">
            <label class="custom-file">
                <input type="file" name="" id="" placeholder="dd" class="custom-file-input"
                    aria-describedby="fileHelpId">
                <span class="custom-file-control"></span>
            </label>
            <small id="fileHelpId" class="form-text text-muted">Help text</small>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
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

    <?php
    function validarContrasenia($contrasenia)
    {
        //la contraseña debe tener al menos una mayuscula, una minuscula, un numero y minimo 8 caracteres.
        $expresion = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";

        if (preg_match($expresion, $contrasenia) === 1) {
            echo "true";
            return;
        }

        echo "false";
    }

    echo "<h1>";
    validarContrasenia("aasjjjJs1");
    echo "</h1>";
    ?>
    <span class="badge badge-danger">Primary</span>
    >

    <p>Click the radio button to toggle between password visibility:</p>

    Password: <input type="password" value="FakePSW" id="myInput"><br><br>
    <input type="checkbox" onclick="myFunction()">Show Password

    <script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
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
                <option value="3" selected>test3</option>
            </select>
        </div>
    </div>

    <div class="container text-center">
        <div class="alert alert-info w-20 fade show">
            <i class="bi bi-info-circle"></i> Hola, soy una alerta
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

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link"
                            href="#">Home <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0"
                        type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>



    <div class="container">
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" value="Mark"
                    required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" value="Otto"
                    required>
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
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                        required>
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

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->




<form action="" method="post">
    <div class="mb-3">
        <label for="" class="form-label">test</label>
        <input type="text" class="form-control" name="text" id="text" aria-describedby="helpId"
            placeholder="">
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</form>

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
echo __DIR__;
/* ***************************************************************** Dependencias ***************************************************************** */
include_once TEMPLATES . "/Pie.php";
/* ************************************************************************************************************************************************ */