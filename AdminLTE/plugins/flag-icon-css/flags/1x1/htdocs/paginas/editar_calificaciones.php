<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();



$consulta = "SELECT * FROM calificacions";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$calificaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM jornadas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$jornadas = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM grados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$grados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$calificacion_id = $_GET['id'];

$consulta = "SELECT * FROM alumnos WHERE id = :calificacion_id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':calificacion_id', $calificacion_id);
$resultado->execute();
$calificacion = $resultado->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar calificaciones</title>
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
                            <h4 class="card-title">Editar Calificación</h4>

                            <form action="{{ route('calificaciones.update', $calificacion->id) }}" method="POST">

                                <div class="form-group">
                                    <label for="alumno_id">Alumno</label>
                                    <select name="alumno_id" id="alumno_id" class="form-control">
                                        <option value="" disabled selected>Selecciona un Alumno</option>
                                        <?php
                                        foreach ($calificaciones as $filtro) {
                                            $selected = ($filtro['id'] == $calificacion['alumno_id']) ? 'selected' : '';
                                            echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['primer_nombre'] . ' ' . $filtro['primer_apellido'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="docente_id">Docente</label>
                                    <select name="docente_id" id="docente_id" class="form-control">
                                        <option value="" disabled selected>Selecciona un Docente</option>
                                        @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}">{{ $docente->persona->primer_nombre }}
                                            {{ $docente->persona->primer_apellido }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="actividad_id">Actividad</label>
                                    <select name="actividad_id" id="actividad_id" class="form-control">
                                        <option value="" disabled selected>Selecciona una Actividad</option>
                                        @foreach ($actividades as $actividad)
                                        <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nota1">Nota 1</label>
                                    <input type="number" name="nota1" id="nota1" class="form-control"
                                        value="{{ $calificacion->nota1 }}">
                                </div>

                                <div class="form-group">
                                    <label for="nota2">Nota 2</label>
                                    <input type="number" name="nota2" id="nota2" class="form-control"
                                        value="{{ $calificacion->nota2 }}">
                                </div>

                                <div class="form-group">
                                    <label for="nota3">Nota 3</label>
                                    <input type="number" name="nota3" id="nota3" class="form-control"
                                        value="{{ $calificacion->nota3 }}">
                                </div>



                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("../../modelo/conexioncrud.php");
    if (isset($_POST['btn_guardar'])) {
        $Idpersona = $_POST['persona_id'];
        $Idgrado = $_POST['grado_id'];
        $Idjornada = $_POST['jornada_id'];

        // Realiza la actualización en la base de datos
        $consulta = "UPDATE alumnos SET persona_id = :persona_id, grado_id = :grado_id, jornada_id = :jornada_id WHERE id = :alumno_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':persona_id', $Idpersona);
        $resultado->bindParam(':grado_id', $Idgrado);
        $resultado->bindParam(':jornada_id', $Idjornada);
        $resultado->bindParam(':alumno_id', $alumno_id);
        $resultado->execute();

        // Realiza cualquier otra acción necesaria, como mostrar un mensaje de éxito o redireccionar a otra página
        echo "<script> alert('Alumno actualizado correctamente');
        location.href = 'alumnos.php';</script>";
    }
    ?>
    </form>

</body>

</html>