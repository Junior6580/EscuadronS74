<?php include 'navbar.php'; ?>
<?php
include_once '../modelo/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$actividadId = $_GET['id'] ?? null;
$editMode = !is_null($actividadId);

if ($editMode) {
    $consulta = "SELECT * FROM actividads WHERE id = :id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $actividadId, PDO::PARAM_INT);
    $resultado->execute();
    $actividad = $resultado->fetch(PDO::FETCH_ASSOC);
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
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
                                <h4 class="card-title">Editar Actividad</h4>
                                <form action="" method="post">
                                    <?php if ($editMode): ?>
                                        <input type="hidden" name="id" value="<?php echo $actividad['id']; ?>">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input class="form-control" type="text" name="nombre" required
                                            value="<?php echo $editMode ? $actividad['nombre'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input class="form-control" type="text" name="descripcion" required
                                            value="<?php echo $editMode ? $actividad['descripcion'] : ''; ?>" </div>
                                        <br>
                                        <button class="btn btn-primary" name="btn_guardar" type="submit">
                                            Actualizar</button>
                                        <a href="actividades.php" class="btn btn-danger btn-xl">Cancelar</a>

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

                if ($Nombre == "" || $Descripcion == "") {
                    echo "<script> alert('Todos los campos son obligatorios');
                    location.href = 'editar_actividades.php';</script>";
                } else {
                    $query = mysqli_query($conectar, "UPDATE actividads SET nombre = '$Nombre', descripcion = '$Descripcion' WHERE id = '$actividadId'");

                    if ($query) {
                        echo "<script> alert('Actividad actualizada correctamente');
                                location.href = 'actividades.php';</script>";
                    }
                }
            }

    } else {
        echo "<script> alert('No Autorizado😡!!');
                        location.href = 'home.php';</script>";
    }
    ?>


</body>

</html>