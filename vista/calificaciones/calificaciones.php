<?php
require_once '../../controlador/css.php';
require_once '../../controlador/js.php';
?>
<?php
include_once '../../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM calificacions";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$calificaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM actividads";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$actividades = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM alumnos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$alumnos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM docentes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$docentes = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaPersonas = "SELECT id, primer_nombre FROM personas";
$resultadoPersonas = $conexion->prepare($consultaPersonas);
$resultadoPersonas->execute();
$personas = $resultadoPersonas->fetchAll(PDO::FETCH_ASSOC);

$personasDic = array();
foreach ($personas as $persona) {
    $personasDic[$persona['id']] = $persona['primer_nombre'];
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
                        <a class="nav-link active" aria-current="page" href="../alumnos/alumnos.php"><i
                                class="fa-sharp fa-solid fa-school fa-2xs" style="color: #000000;"> </i> Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../docentes/docentes.php"><i
                                class="fa-solid fa-chalkboard-user fa-2xs" style="color: #000000;"> </i> Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="calificaciones.php"><i
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Calificaciones</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Alumno Id</th>
                                    <th>Docente Id</th>
                                    <th>Actividad Id</th>
                                    <th>Promedio</th>
                                    <th style="width: 200px;"><a href="nuevo_docente.php"
                                            class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                style="color: #050505;"></i></a></th>
                            </thead>
                            <tbody>


                                <?php
                                foreach ($calificaciones as $filtro) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $filtro['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['alumno_id'] ?>
                                            <?php $personaId = $filtro['alumno_id'];
                                            foreach ($personas as $persona) {
                                                if ($persona['id'] == $personaId) {
                                                    echo $persona['primer_nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['docente_id'] ?>
                                            <?php $personaId = $filtro['docente_id'];
                                            foreach ($personas as $persona) {
                                                if ($persona['id'] == $personaId) {
                                                    echo $persona['primer_nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['actividad_id'] ?>
                                            <?php $actividadId = $filtro['actividad_id'];
                                            foreach ($actividades as $actividad) {
                                                if ($actividad['id'] == $actividadId) {
                                                    echo $actividad['nombre'];
                                                    break;
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $filtro['promedio'] ?>
                                        </td>

                                        <td><a href="editar_docentes.php?id=<?php echo $filtro['id']; ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="eliminar_docentes.php?id=<?php echo $filtro['id']; ?>"
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

</body>

</html>