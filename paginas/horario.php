<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM horarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$horarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

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

$consultaMaterias = "SELECT id, nombre FROM materias";
$resultadoMaterias = $conexion->prepare($consultaMaterias);
$resultadoMaterias->execute();
$materias = $resultadoMaterias->fetchAll(PDO::FETCH_ASSOC);

$materiasDic = array();
foreach ($materias as $materia) {
    $materiasDic[$materia['id']] = $materia['nombre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
</head>

<body>
    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Horarios</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="grado">Seleccionar grado:</label>
                                <select name="grado" id="grado" class="form-control">
                                    <option value="">Todos los grados</option>
                                    <?php
                                    foreach ($grados as $grado) {
                                        echo "<option value='" . $grado['id'] . "'>" . $grado['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                            <?php
                            if ($rol == 1) {
                                ?>
                                <a href="nuevo_horario.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"
                                        style="color: #050505;"></i></a>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <?php
                    $gradoFiltrado = $_POST['grado'] ?? '';

                    foreach ($horarios as $horario) {
                        $gradoId = $horario['grado_id'];

                        if ($gradoFiltrado !== '' && $gradoFiltrado != $gradoId) {
                            continue;
                        }
                        ?>
                        <div class="card-body">
                            <table id="datatable" class="table table-sm table-striped">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Dia de la semana</th>
                                        <th>Hora Inicio</th>
                                        <th>Hora Fin</th>
                                        <th>Materia Id</th>
                                        <th>Grado Id</th>
                                        <?php
                                        if ($rol == 1) {
                                            ?>
                                            <th style="width: 200px;"></th>
                                            <?php
                                        }
                                        ?>
                                </thead>
                                <tbody>
                                    <td>
                                        <?php echo $horario['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $horario['dia_de_la_semana'] ?>
                                    </td>
                                    <td>
                                        <?php echo $horario['hora_inicio'] ?>
                                    </td>
                                    <td>
                                        <?php echo $horario['hora_fin'] ?>
                                    </td>
                                    <td>
                                        <?php echo $horario['materia_id'] ?>
                                        <?php
                                        $materiaId = $horario['materia_id'];
                                        foreach ($materias as $materia) {
                                            if ($materia['id'] == $materiaId) {
                                                echo $materia['nombre'];
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $horario['grado_id'] ?>
                                        <?php
                                        foreach ($grados as $grado) {
                                            if ($grado['id'] == $gradoId) {
                                                echo $grado['nombre'];
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if ($rol == 1) {
                                        ?>
                                        <td><a href="editar_horario.php?id=<?php echo $horario['id']; ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                            <a href="eliminar_horario.php?id=<?php echo $horario['id']; ?>"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>






</body>


</html>