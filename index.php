<?php
require_once 'controlador/css.php';
require_once 'controlador/js.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        .jumbotron {
            background-image: url('img/bienvenido.png');
            background-size: 1518px 700px;
            background-position: center;
            color: #040202;
            height: 700px;
            width: 1518px;
            margin-bottom: 0%;
        }
    </style>
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
                        <a class="nav-link" href="vista/login/login.php"><i
                                class="fa-sharp fa-solid fa-right-to-bracket fa-xs" style="color: #000000;">
                                Login</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
        </div>
    </div>
    <footer class="footer">

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-dark" href="{{ route('home') }}">EscuadronS74.com</a>
        </div>
    </footer>
</body>

</html>