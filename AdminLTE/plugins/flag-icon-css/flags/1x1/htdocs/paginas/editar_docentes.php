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

$docente_id = $_GET['id'];

$consulta = "SELECT * FROM docentes WHERE id = :docente_id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':docente_id', $docente_id);
$resultado->execute();
$docente = $resultado->fetch(PDO::FETCH_ASSOC);

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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning">Editar Docentes</div>
                    <div class="card-body">
                        <form action="" method="post">

                            <label for="persona_id">Selecciona Persona Id:</label>
                            <select class="form-control" name="persona_id" id="persona_id">
                                <option value="">Seleccione Persona Id:</option>
                                <?php
                                foreach ($usuarios as $filtro) {
                                    $selected = ($filtro['id'] == $docente['persona_id']) ? 'selected' : '';
                                    echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['primer_nombre'] . ' ' . $filtro['primer_apellido'] . "</option>";
                                }
                                ?>
                            </select><br>

                            <label for="jornada_id">Selecciona Jornada Id:</label>
                            <select class="form-control" name="jornada_id" id="jornada_id">
                                <option value="">Seleccione Jornada Id:</option>
                                <?php
                                foreach ($jornadas as $filtro) {
                                    $selected = ($filtro['id'] == $docente['jornada_id']) ? 'selected' : '';
                                    echo "<option value='" . $filtro['id'] . "' $selected>" . $filtro['id'] . ' ' . $filtro['nombre'] . "</option>";
                                }
                                ?>
                            </select><br>

                            <button class="btn btn-primary" name="btn_guardar" type="submit">Editar</button>
                            <a href="docentes.php" class="btn btn-danger btn-xl">Cancelar</a>
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
        $Idjornada = $_POST['jornada_id'];

        // Realiza la actualización en la base de datos
        $consulta = "UPDATE docentes SET persona_id = :persona_id, jornada_id = :jornada_id WHERE id = :docente_id";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':persona_id', $Idpersona);
        $resultado->bindParam(':jornada_id', $Idjornada);
        $resultado->bindParam(':docente_id', $docente_id);
        $resultado->execute();

        // Realiza cualquier otra acción necesaria, como mostrar un mensaje de éxito o redireccionar a otra página
        echo "<script> alert('Docente actualizado correctamente');
        location.href = 'docentes.php';</script>";
    }
    ?>
    </form>

</body>

</html>