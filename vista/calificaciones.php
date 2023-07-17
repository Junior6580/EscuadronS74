<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
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
    <title>Calificaciones</title>
</head>

<body>

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
                                    <?php
                                    if ($rol == 1 || $rol == 2) {
                                        ?>
                                        <th style="width: 200px;"><a href="nueva_calificacion.php"
                                                class="btn btn-success btn-sm"><i class="fa-solid fa-circle-plus"
                                                    style="color: #050505;"></i></a></th>
                                        <?php
                                    }
                                    ?>
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
                                        <?php
                                        if ($rol == 1 || $rol == 2) {
                                            ?>
                                            <td><a href="editar_calificaciones.php?id=<?php echo $filtro['id']; ?>"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="elimina_calificaciones.php?id=<?php echo $filtro['id']; ?>"
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

</body>

</html>