<?php
include("Plantillas/CabeceraLogin.php");

function obtenerNombrePagina()
{
    return pathinfo(__FILE__, PATHINFO_FILENAME);
}

if ($_POST) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
}

?>
<br>
<br>

<body>
    <div class="container row-cols-xl-2 align-items-center">
        <div class="container">
            <div class="card">
                <div class="card-header card-header text-white text-center bg-dark">
                    <img class="card-img-top text-center" src="img/header.jpg" alt="A library image">
                    Login
                </div>
                <div class="card-body">

                    <form action="Login.php" method="POST">
                        <div class="mb-3">
                            <label for="usuarior" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuarior" aria-describedby="usuarioHelp"
                                placeholder="Ingresa tu usuario" required>
                            <div id="emailHelp" class="form-text">Si no estas registrado comunicate con un administrador
                                o
                                con tu organizacion.</div>
                        </div>
                        <div class="mb-3">
                            <label for="contrasenia" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenia" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>

                </div>
                <div class="card-footer bg-dark text-muted">

                </div>
            </div>
        </div>
    </div>
</body>

<?php
include("Plantillas/Pie.php");
#echo password_hash("Administrador", PASSWORD_BCRYPT);
#echo password_verify("Administrador", "$2y$10$1VkIpEU/f.m7PIqnwFJ5murNb7njpiYpbz9Jrteih7rsx7VwQDoxq") ? "iguales" : "diferentes";
?>