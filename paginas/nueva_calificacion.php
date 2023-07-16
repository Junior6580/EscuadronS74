<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Query to fetch calificaciones
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Calificación</title>
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
                        <!--form mask starts-->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registrar Calificación</h4>
                                <p class="card-description">Ingresar calificaciones de los alumnos</p>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="alumno_id">Alumno</label>
                                            <select name="alumno_id" id="alumno_id" class="form-control">
                                                <option value="" disabled selected>Seleccionar Alumno</option>
                                                <?php
                                                foreach ($alumnos as $alumno) {
                                                    $alumnoId = $alumno['persona_id'];
                                                    $Id = $alumno['id'];
                                                    $nombreAlumno = $personasDic[$alumnoId];
                                                    echo "<option value='$alumnoId'>$Id $nombreAlumno</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="docente_id">Docente</label>
                                            <select name="docente_id" id="docente_id" class="form-control">
                                                <option value="" disabled selected>Seleccionar Docente</option>
                                                <?php
                                                foreach ($docentes as $docente) {
                                                    $docenteId = $docente['persona_id'];
                                                    $docenId = $docente['id'];
                                                    $nombreDocente = $personasDic[$docenteId];
                                                    echo "<option value='$docenteId'>$docenId $nombreDocente</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="actividad_id">Actividad</label>
                                        <select name="actividad_id" id="actividad_id" class="form-control">
                                            <option value="" disabled selected>Selecciona una Actividad</option>
                                            <?php
                                            foreach ($actividades as $actividad) {
                                                ?>
                                                <option>
                                                    <?php echo $actividad['id'] ?>
                                                    <?php echo $actividad['nombre'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="nota1">Nota 1</label>
                                            <input type="number" name="nota1" id="nota1" class="form-control" required>
                                        </div>
                                        <div class="col">
                                            <label for="nota2">Nota 2</label>
                                            <input type="number" name="nota2" id="nota2" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nota3">Nota 3</label>
                                        <input type="number" name="nota3" id="nota3" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="promedio">Promedio</label>
                                        <input type="text" name="promedio" id="promedio" class="form-control" readonly>
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
                                    <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
                                    <a href="calificaciones.php" class="btn btn-danger btn-xl">Cancelar</a>

                            </div>
                        </div>
                        <!--form mask ends-->
                    </div>
                </div>
            </div>
            <!--form mask ends-->
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
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nueva_calificacion.php';</script>";
            } else {

                $query = mysqli_query($conectar, "INSERT INTO calificacions (alumno_id, docente_id, actividad_id, nota1, nota2, nota3, promedio)values('$Idalumno', '$Iddocente', '$Idactividad', '$Notauno', '$Notados', '$Notatres', '$Promedio')");
                if ($query) {
                    echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nueva_calificacion.php';</script>";
                }
            }
        }
        ?>
        </form>
        <?php
    } else {
        echo "<script> alert('No Autorizado😡!!');
                    location.href = 'home.php';</script>";
    }
    ?>

</body>

</html>