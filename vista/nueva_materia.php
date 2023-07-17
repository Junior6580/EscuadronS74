<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT * FROM materias";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$materias = $resultado->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Nueva Materia</title>
</head>

<body>
    <br>
    <?php
    if ($rol == 1) {
        ?>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row justify-content-center">
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registrar Materia</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input class="form-control" type="text" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input class="form-control" type="text" name="descripcion" required>
                                    </div>
                                    <div class="form-group">
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
                                    <br>
                                    <button class="btn btn-primary" name="btn_guardar" type="submit">Agregar</button>
                                    <a href="materias.php" class="btn btn-danger btn-xl">Cancelar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../modelo/conexioncrud.php");
        if (isset($_POST['btn_guardar'])) {
            $Nombre = $_POST['nombre'];
            $Descripcion = $_POST['descripcion'];
            $Iddocente = $_POST['docente_id'];

            if ($Nombre == "" || $Descripcion == "" || $Iddocente == "") {
                echo "<script> alert('Todos los campos son obligatorios ')
              location.href = 'nueva_materia.php';</script>";
            } else {

                $query = mysqli_query($conectar, "INSERT INTO materias (nombre, descripcion, docente_id)values('$Nombre', '$Descripcion', '$Iddocente')");
                if ($query) {
                    echo "<script> alert('Registro Exitoso!!!')
                location.href = 'nueva_materia.php';</script>";
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