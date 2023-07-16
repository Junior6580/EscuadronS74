<?php
include 'navbar.php';
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM grados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$grados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM materias";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$materias = $resultado->fetchAll(PDO::FETCH_ASSOC);

$HorarioId = $_GET['id'] ?? '';


$consultaHorario = "SELECT * FROM horarios WHERE id = :HorarioId";
$resultadoHorario = $conexion->prepare($consultaHorario);
$resultadoHorario->bindParam(':HorarioId', $HorarioId, PDO::PARAM_INT);
$resultadoHorario->execute();
$horario = $resultadoHorario->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Horario</title>
</head>

<body>

    <br>
    <?php
    if ($rol == 1) {
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-success">Editar Horario</div>
                        <div class="card-body">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="dia_de_la_semana">Dia de la semana:</label>
                                    <select class="form-control" id="dia_de_la_semana" name="dia_de_la_semana">
                                        <option value="">Seleccione día</option>
                                        <option value="Lunes" <?php if ($horario['dia_de_la_semana'] == 'Lunes')
                                            echo 'selected'; ?>>Lunes
                                        </option>
                                        <option value="Martes" <?php if ($horario['dia_de_la_semana'] == 'Martes')
                                            echo 'selected'; ?>>Martes
                                        </option>
                                        <option value="Miércoles" <?php if ($horario['dia_de_la_semana'] == 'Miércoles')
                                            echo 'selected'; ?>>
                                            Miércoles</option>
                                        <option value="Jueves" <?php if ($horario['dia_de_la_semana'] == 'Jueves')
                                            echo 'selected'; ?>>Jueves
                                        </option>
                                        <option value="Viernes" <?php if ($horario['dia_de_la_semana'] == 'Viernes')
                                            echo 'selected'; ?>>Viernes
                                        </option>
                                    </select>


                                </div>

                                <div class="form-group">
                                    <label for="hora_inicio">Hora de inicio:</label>
                                    <input class="form-control" type="time" name="hora_inicio"
                                        value="<?php echo $horario['hora_inicio']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="hora_fin">Hora de fin:</label>
                                    <input class="form-control" type="time" name="hora_fin"
                                        value="<?php echo $horario['hora_fin']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="materia_id">Materia:</label>
                                    <select class="form-control" name="materia_id" required>
                                        <option value="">Seleccione Materia:</option>
                                        <?php
                                        foreach ($materias as $materia) {
                                            $selected = ($materia['id'] == $horario['materia_id']) ? 'selected' : '';
                                            echo "<option value='" . $materia['id'] . "' $selected>" . $materia['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="grado_id">Grado:</label>
                                    <select class="form-control" name="grado_id" required>
                                        <option value="0">Seleccione grado</option>
                                        <?php
                                        foreach ($grados as $grado) {
                                            $selected = ($grado['id'] == $horario['grado_id']) ? 'selected' : '';
                                            echo "<option value='" . $grado['id'] . "' $selected>" . $grado['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <br>

                                <button class="btn btn-primary" name="btn_actualizar" type="submit">Actualizar</button>
                                <a href="horario.php" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_actualizar'])) {
            $Dia = $_POST['dia_de_la_semana'];
            $Inicio = $_POST['hora_inicio'];
            $Fin = $_POST['hora_fin'];
            $Materia = $_POST['materia_id'];
            $Grado = $_POST['grado_id'];

            if ($Dia == "" || $Inicio == "" || $Fin == "" || $Materia == "" || $Grado == "") {
                echo "<script> alert('Todos los campos son obligatorios');
              location.href = 'horario.php';</script>";
            } else {
                $query = mysqli_query($conectar, "UPDATE horarios SET dia_de_la_semana = '$Dia', hora_inicio = '$Inicio', hora_fin = '$Fin', materia_id = '$Materia', grado_id = '$Grado' WHERE id = $HorarioId");
                if ($query) {
                    echo "<script> alert('Horario actualizada exitosamente'); location.href = 'horario.php'; </script>";
                }
            }
        }
        ?>
        <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>