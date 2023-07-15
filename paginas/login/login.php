<?php
require_once '../../controlador/css.php';
require_once '../../controlador/js.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php"><i class="fa-solid fa-house fa-xs"
                                style="color: #000000;">
                                Bienvenido</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="custom-background">
        <main class="py-4">
            <div class="container">
                <div id="js" class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="jm" class="card">
                            <div class="card-header dt-center">Escuela Cultural</div>
                            <div class="card-body">
                                <form action="validar.php" method="post">
                                    <div class="row mb-3">

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo
                                                Electronico</label>

                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="usuario" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                            <div class="col-md-6">
                                                <input class="form-control" type="password" name="contraseña" required>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-10 offset-md-6">
                                                <input class="btn btn-primary" type="submit" value="Login">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
</body>

</html>