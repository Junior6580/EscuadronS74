<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM jornadas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$jornadas = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM grados";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$grados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$alumno_id = $_GET['id'];

$consulta = "SELECT * FROM alumnos WHERE id = :alumno_id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':alumno_id', $alumno_id);
$resultado->execute();
$alumno = $resultado->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumnos</title>
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
                    <div class="card-header bg-warning">Editar Alumnos</div>
                    <div class="card-body">
                        <form action="" method="post">

                            <label for="persona_id">Selecciona Persona Id:</label>
                            <select class="form-control" name="persona_id" id="persona_id">
                                <option value="">Seleccione Persona Id:</option>
                                <?php
                                    foreach ($usuarios as $filtro) {
                                        $selected = ($filtro['id'] == $alumno['persona_id']) ? 'selected' : '';
                                        echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['primer_nombre'] . ' ' . $filtro['primer_apellido'] . "</option>";
                                    }
                                    ?>
                            </select><br>

                            <label for="grado_id">Selecciona Grado Id:</label>
                            <select class="form-control" name="grado_id" id="grado_id">
                                <option value="">Seleccione Grado Id:</option>
                                <?php
                                    foreach ($grados as $filtro) {
                                        $selected = ($filtro['id'] == $alumno['grado_id']) ? 'selected' : '';
                                        echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['nombre'] . "</option>";
                                    }
                                    ?>
                            </select><br>

                            <label for="jornada_id">Selecciona Jornada Id:</label>
                            <select class="form-control" name="jornada_id" id="jornada_id">
                                <option value="">Seleccione Jornada Id:</option>
                                <?php
                                    foreach ($jornadas as $filtro) {
                                        $selected = ($filtro['id'] == $alumno['jornada_id']) ? 'selected' : '';
                                        echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['nombre'] . "</option>";
                                    }
                                    ?>
                            </select><br>

                            <button class="btn btn-primary" name="btn_guardar" type="submit">Actualizar</button>
                            <a href="alumnos.php" class="btn btn-danger btn-xl">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Idpersona = $_POST['persona_id'];
            $Idgrado = $_POST['grado_id'];
            $Idjornada = $_POST['jornada_id'];

            $consulta = "UPDATE alumnos SET persona_id = :persona_id, grado_id = :grado_id, jornada_id = :jornada_id WHERE id = :alumno_id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':persona_id', $Idpersona);
            $resultado->bindParam(':grado_id', $Idgrado);
            $resultado->bindParam(':jornada_id', $Idjornada);
            $resultado->bindParam(':alumno_id', $alumno_id);
            $resultado->execute();

            echo "<script> alert('Alumno actualizado correctamente');
        location.href = 'alumnos.php';</script>";
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