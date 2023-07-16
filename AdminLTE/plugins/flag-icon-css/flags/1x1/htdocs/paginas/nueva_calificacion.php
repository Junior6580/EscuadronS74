<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

include 'navbar.php';

// Query to fetch calificaciones
$consultaCalificaciones = "SELECT * FROM calificacions";
$resultadoCalificaciones = $conexion->prepare($consultaCalificaciones);
$resultadoCalificaciones->execute();
$calificaciones = $resultadoCalificaciones->fetchAll(PDO::FETCH_ASSOC);

// Query to fetch actividades
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

if (isset($_POST['btn_guardar'])) {
    $Idpersona = $_POST['persona_id'];
    $Idgrado = $_POST['grado_id'];
    $Idjornada = $_POST['jornada_id'];

    if ($Idpersona == "" || $Idgrado == "" || $Idjornada == "") {
        echo "<script> alert('Todos los campos son obligatorios ')
          location.href = 'nuevo_alumno.php';</script>";
    } else {

        $query = mysqli_query($conectar, "INSERT INTO alumnos (persona_id, grado_id, jornada_id)values('$Idpersona', '$Idgrado', '$Idjornada')");
        if ($query) {
            echo "<script> alert('Registro Exitoso!!!')
            location.href = 'nuevo_alumno.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Alumno</title>
</head>

<body>
    <br>
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
                                            foreach ($calificaciones as $filtro) {
                                                ?>
                                                <option value="<?php echo $filtro['alumno_id'] ?>">
                                                    <?php echo $personasDic[$filtro['alumno_id']] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="col">
                                        <label for="docente_id">Docente</label>
                                        <select name="docente_id" id="docente_id" class="form-control">
                                            <option value="" disabled selected>Seleccionar Docente</option>
                                            <?php foreach ($docentes as $docente): ?>
                                                <option value="<?php echo $docente->id; ?>">
                                                    <?php echo $docente->persona->primer_nombre . ' ' . $docente->persona->primer_apellido; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="actividad_id">Actividad</label>
                                    <select name="actividad_id" id="actividad_id" class="form-control">
                                        <option value="" disabled selected>Selecciona una Actividad</option>
                                        <?php foreach ($actividades as $actividad): ?>
                                            <option value="<?php echo $actividad->id; ?>"><?php echo $actividad->nombre; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="nota1">Nota 1</label>
                                        <input type="number" name="nota1" id="nota1" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="nota2">Nota 2</label>
                                        <input type="number" name="nota2" id="nota2" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nota3">Nota 3</label>
                                    <input type="number" name="nota3" id="nota3" class="form-control">
                                </div>
                                <br>
                                <button type="submit" name="btn_guardar" class="btn btn-primary">Guardar</button>
                                <a href="calificaciones.php" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>
                    </div>
                    <!--form mask ends-->
                </div>
            </div>
        </div>
        <!--form mask ends-->
    </div>
</body>

</html>
