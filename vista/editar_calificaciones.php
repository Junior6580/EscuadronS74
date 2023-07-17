<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consultaCalificaciones = "SELECT * FROM calificacions";
$resultadoCalificaciones = $conexion->prepare($consultaCalificaciones);
$resultadoCalificaciones->execute();
$calificaciones = $resultadoCalificaciones->fetchAll(PDO::FETCH_ASSOC);

$consultaAlumnos = "SELECT * FROM alumnos";
$resultadoAlumnos = $conexion->prepare($consultaAlumnos);
$resultadoAlumnos->execute();
$alumnos = $resultadoAlumnos->fetchAll(PDO::FETCH_ASSOC);

$consultaDocentes = "SELECT * FROM docentes";
$resultadoDocentes = $conexion->prepare($consultaDocentes);
$resultadoDocentes->execute();
$docentes = $resultadoDocentes->fetchAll(PDO::FETCH_ASSOC);

$consultaActividades = "SELECT * FROM actividads";
$resultadoActividades = $conexion->prepare($consultaActividades);
$resultadoActividades->execute();
$actividades = $resultadoActividades->fetchAll(PDO::FETCH_ASSOC);

$consultaPersonas = "SELECT id, primer_nombre FROM personas";
$resultadoPersonas = $conexion->prepare($consultaPersonas);
$resultadoPersonas->execute();
$personas = $resultadoPersonas->fetchAll(PDO::FETCH_ASSOC);

$personasDic = array();
foreach ($personas as $persona) {
    $personasDic[$persona['id']] = $persona['primer_nombre'];
}


$calificacionId = $_GET['id'] ?? '';


$consultaCalificacion = "SELECT * FROM calificacions WHERE id = :calificacionId";
$resultadoCalificacion = $conexion->prepare($consultaCalificacion);
$resultadoCalificacion->bindParam(':calificacionId', $calificacionId, PDO::PARAM_INT);
$resultadoCalificacion->execute();
$calificacion = $resultadoCalificacion->fetch(PDO::FETCH_ASSOC);

if (!$calificacion) {
    echo "<script> alert('Calificación no encontrada'); location.href = 'calificaciones.php'; </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Calificación</title>
</head>

<body>
    <br>
    <?php
    if ($rol == 1 || $rol == 2) {
        ?>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row justify-content-center">
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar Calificación</h4>
                                <p class="card-description">Modificar la calificación de los alumnos</p>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="alumno_id">Alumno</label>
                                            <select name="alumno_id" id="alumno_id" class="form-control">
                                                <option value="" disabled>Seleccionar Alumno</option>
                                                <?php
                                                foreach ($alumnos as $alumno) {
                                                    $alumnoId = $alumno['persona_id'];
                                                    $Id = $alumno['id'];
                                                    $nombreAlumno = $personasDic[$alumnoId];
                                                    $selected = $alumnoId == $calificacion['alumno_id'] ? 'selected' : '';
                                                    echo "<option value='$alumnoId' $selected>$Id $nombreAlumno</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="docente_id">Docente</label>
                                            <select name="docente_id" id="docente_id" class="form-control">
                                                <option value="" disabled>Seleccionar Docente</option>
                                                <?php
                                                foreach ($docentes as $docente) {
                                                    $docenteId = $docente['persona_id'];
                                                    $docenId = $docente['id'];
                                                    $nombreDocente = $personasDic[$docenteId];
                                                    $selected = $docenteId == $calificacion['docente_id'] ? 'selected' : '';
                                                    echo "<option value='$docenteId' $selected>$docenId $nombreDocente</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="actividad_id">Actividad</label>
                                        <select name="actividad_id" id="actividad_id" class="form-control">
                                            <option value="" disabled>Selecciona una Actividad</option>
                                            <?php
                                            foreach ($actividades as $actividad) {
                                                $actividadId = $actividad['id'];
                                                $nombreActividad = $actividad['nombre'];
                                                $selected = $actividadId == $calificacion['actividad_id'] ? 'selected' : '';
                                                echo "<option value='$actividadId' $selected>$actividadId $nombreActividad</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="nota1">Nota 1</label>
                                            <input type="number" name="nota1" id="nota1" class="form-control" required
                                                value="<?php echo $calificacion['nota1']; ?>">
                                        </div>
                                        <div class="col">
                                            <label for="nota2">Nota 2</label>
                                            <input type="number" name="nota2" id="nota2" class="form-control" required
                                                value="<?php echo $calificacion['nota2']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nota3">Nota 3</label>
                                        <input type="number" name="nota3" id="nota3" class="form-control" required
                                            value="<?php echo $calificacion['nota3']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="promedio">Promedio</label>
                                        <input type="text" name="promedio" id="promedio" class="form-control" readonly
                                            value="<?php echo $calificacion['promedio']; ?>">
                                    </div>

                                    <script>
                                        var nota1Input = document.getElementById("nota1");
                                        var nota2Input = document.getElementById("nota2");
                                        var nota3Input = document.getElementById("nota3");

                                        var promedioInput = document.getElementById("promedio");


                                        nota1Input.addEventListener("input", calcularPromedio);
                                        nota2Input.addEventListener("input", calcularPromedio);
                                        nota3Input.addEventListener("input", calcularPromedio);

                                        function calcularPromedio() {

                                            var nota1 = parseFloat(nota1Input.value);
                                            var nota2 = parseFloat(nota2Input.value);
                                            var nota3 = parseFloat(nota3Input.value);


                                            var promedio = (nota1 + nota2 + nota3) / 3;


                                            promedioInput.value = promedio.toFixed(2);
                                        }
                                    </script>
                                    <br>
                                    <button class="btn btn-primary" name="btn_guardar" type="submit">Actualizar</button>
                                    <a href="calificaciones.php" class="btn btn-danger btn-xl">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Idalumno = $_POST['alumno_id'];
            $Iddocente = $_POST['docente_id'];
            $Idactividad = $_POST['actividad_id'];
            $Notauno = $_POST['nota1'];
            $Notados = $_POST['nota2'];
            $Notatres = $_POST['nota3'];
            $Promedio = $_POST['promedio'];

            if ($Idalumno == "" || $Iddocente == "" || $Idactividad == "") {
                echo "<script> alert('Todos los campos son obligatorios'); </script>";
            } else {
                $query = mysqli_query($conectar, "UPDATE calificacions SET alumno_id = '$Idalumno', docente_id = '$Iddocente', actividad_id = '$Idactividad', nota1 = '$Notauno', nota2 = '$Notados', nota3 = '$Notatres', promedio = '$Promedio' WHERE id = $calificacionId");
                if ($query) {
                    echo "<script> alert('Calificación actualizada exitosamente'); location.href = 'calificaciones.php'; </script>";
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