<?php
require_once '../../controlador/css.php';
require_once '../../controlador/js.php';
?>
<?php
include_once '../../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM alumnos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaPersonas = "SELECT id, primer_nombre FROM personas";
$resultadoPersonas = $conexion->prepare($consultaPersonas);
$resultadoPersonas->execute();
$personas = $resultadoPersonas->fetchAll(PDO::FETCH_ASSOC);

$personasDic = array();
foreach ($personas as $persona) {
    $personasDic[$persona['id']] = $persona['primer_nombre'];
}

$consultaGrados = "SELECT id, nombre FROM grados";
$resultadoGrados = $conexion->prepare($consultaGrados);
$resultadoGrados->execute();
$grados = $resultadoGrados->fetchAll(PDO::FETCH_ASSOC);

$gradosDic = array();
foreach ($grados as $grado) {
    $gradosDic[$grado['id']] = $grado['nombre'];
}

$consultaJornadas = "SELECT id, nombre FROM jornadas";
$resultadoJornadas = $conexion->prepare($consultaJornadas);
$resultadoJornadas->execute();
$jornadas = $resultadoJornadas->fetchAll(PDO::FETCH_ASSOC);

$jornadasDic = array();
foreach ($jornadas as $jornada) {
    $jornadasDic[$jornada['id']] = $jornada['nombre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container">
            <a class="navbar-brand" href="../home.php"><i class="fa-solid fa-graduation-cap  fa-xs"
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
                        <a class="nav-link active" aria-current="page" href="../home.php"><i
                                class="fa-solid fa-house fa-2xs" style="color: #000000;"> </i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="alumnos.php"><i
                                class="fa-sharp fa-solid fa-school fa-2xs" style="color: #000000;"> </i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../docentes/docentes.php"><i
                                class="fa-solid fa-chalkboard-user fa-2xs" style="color: #000000;"> </i> Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../calificaciones/calificaciones.php"><i
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
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h6 class="card-title">Promedios</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Alumnos</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Grado</th>
                                    <th>Jornada</th>
                                    <th style="width: 200px;"><a href="nuevo_alumno.php"
                                            class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                style="color: #050505;"></i></a></th>
                            </thead>
                            <tbody>


                                <?php
                                foreach ($usuarios as $filtro) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $filtro['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['persona_id'] ?>
                                            <?php $personaId = $filtro['persona_id'];
                                            foreach ($personas as $persona) {
                                                if ($persona['id'] == $personaId) {
                                                    echo $persona['primer_nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['grado_id'] ?>
                                            <?php $gradoId = $filtro['grado_id'];
                                            foreach ($grados as $grado) {
                                                if ($grado['id'] == $gradoId) {
                                                    echo $grado['nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['jornada_id'] ?>
                                            <?php $jornadaId = $filtro['jornada_id'];
                                            foreach ($jornadas as $jornada) {
                                                if ($jornada['id'] == $jornadaId) {
                                                    echo $jornada['nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td><a href="editar_alumnos.php?id=<?php echo $filtro['id']; ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="eliminar_alumno.php?id=<?php echo $filtro['id']; ?>"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br>
    <footer class="footer">

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-dark" href="{{ route('home') }}">EscuadronS74.com</a>
        </div>
    </footer>

</body>
<script>
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: @json($nombresAlumnos),

        datasets: [{
            label: 'Promedio de alumnos',
            backgroundColor: 'rgba(52, 152, 219 )',
            borderColor: 'rgba(84, 153, 199)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: @json($promedios)
        },]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })
</script>


</html>