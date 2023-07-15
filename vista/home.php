<?php
require_once '../controlador/css.php';
require_once '../controlador/js.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><i class="fa-solid fa-graduation-cap  fa-xs"
                    style="color: #000000;">

                </i> Escuela Cultural</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php"><i
                                class="fa-solid fa-house fa-2xs" style="color: #000000;"> </i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="alumnos/alumnos.php"><i
                                class="fa-sharp fa-solid fa-school fa-2xs" style="color: #000000;"> </i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="docentes.php"><i
                                class="fa-solid fa-chalkboard-user fa-2xs" style="color: #000000;"> </i> Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i
                                class="fa-sharp fa-solid fa-arrow-down-1-9 fa-2xs" style="color: #000000;">
                            </i> Calificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i
                                class="fa-sharp fa-solid fa-clock  fa-2xs" style="color: #000000;"> </i> Horarios</a>
                    </li>
                    <li class="nav-item">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-puzzle-piece fa-2xs" style="color: #04070c;">
                            </i> Registros</a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-book-journal-whills fa-2xs" style="color: #000000;">
                                </i>Materias</a>
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-stopwatch-20 fa-2xs" style="color: #06090f;"> </i>Jornadas</a>

                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-arrow-down-1-9 fa-2xs" style="color: #04070c;"> </i>Grados</a>

                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-chart-line fa-2xs" style="color: #000000;"> </i>Actividades</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-user-tie fa-2xs" style="color: #000000;">
                            </i>
                            Perfiles
                        </a>


                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-user fa-2xs" style="color: #000000;"> </i>Usuarios</a>
                            <a class="dropdown-item" href="">
                                <i class="fa-solid fa-person fa-2xs" style="color: #000000;"> </i>Personas</a>


                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="home" class="jumbotron">
        <div class="container">

            <h1 class="display-4">WELCOME</h1>
            <p class="lead">Que Deseas Hacer?</p>
        </div>

    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/estudiantes.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Registrar Alumnos</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/grupos.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Administrar Grupos</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/boletines.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Boletines</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/materias.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Registrar Materias</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/docentes.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Administrar Docentes</strong></p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/grafico.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Gráficos De Crecimiento</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/horarios.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Horarios De Clase</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/7502.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Registrar Calificaciones</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/md.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Materias De Docentes</strong></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 12rem;">
                    <img src="../img/imprimir.jpg" class="card-img-top" alt="..." height="220">
                    <div class="card-body">
                        <p class="text-center"><strong>Imprimir Horarios</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <footer class="footer">

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-dark" href="{{ route('home') }}">EscuadronS74.com</a>
        </div>
    </footer>
</body>

</html>