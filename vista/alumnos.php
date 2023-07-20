<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
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


// Datos de ejemplo
$nombresAlumnos = ['Juan', 'María', 'Carlos', 'Ana'];
$promedios = [85, 92, 78, 88];

// Convertir los datos a formato JSON
$nombresAlumnosJson = json_encode($nombresAlumnos);
$promediosJson = json_encode($promedios);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <br>
    <?php
    if ($rol == 1 || $rol == 2) {
        ?>
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
                                        <?php
                                        if ($rol == 1) {
                                            ?>
                                            <th style="width: 200px;"><a href="nuevo_alumno.php"
                                                    class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                        style="color: #050505;"></i></a></th>
                                            <?php
                                        }
                                        ?>
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
                                            <?php
                                            if ($rol == 1) {
                                                ?>
                                                <td><a href="editar_alumnos.php?id=<?php echo $filtro['id']; ?>"
                                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="eliminar_alumno.php?id=<?php echo $filtro['id']; ?>"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <?php
                                            }
                                            ?>
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
        <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>
<script>
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: <?php echo json_encode($jornadasDic); ?>,

        datasets: [{
            label: 'Promedio de alumnos',
            backgroundColor: 'rgba(52, 152, 219 )',
            borderColor: 'rgba(84, 153, 199)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: <?php echo json_encode($promedios); ?>,
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

    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })
</script>


</html>